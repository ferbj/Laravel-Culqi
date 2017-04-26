<?php 
namespace App\Http\Controllers;
use App\Celular;
use Illuminate\Http\Request;
use Culqi\Culqi;
use Culqi\CulqiException;
use App\Payment;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
Class PaymentController extends Controller{

public function index(){
        $celulares = Celular::all();
    return view('index',compact('celulares'));
}


public function Test($id){
        $celular=Celular::find($id);
   return $celular->precio*100;
}

public function comprar($id){
        $celular = Celular::find($id);    
    $departamentos= DB::select('SELECT IdDepa,ucwords(departamento) as departamento FROM departamento order by departamento ASC');
    return view('celular', array('celular' => $celular,'departamentos'=>$departamentos));
}
/*Método que envia tokenizacion y crea venta en culqi*/
public function pago(Request $request){
    $token=$request->input('token');
    $id_producto=$request->input('id_producto');
    $user = Auth::user();
    $celular=Celular::find($id_producto);
    $celulares = Celular::all();
    //exit();
    if($token){
        // Configurar tu API Key
        //$SECRET_API_KEY = "ASa3QY0uw8LZ9eo9MM7zYzQRsZgQil7LR6UhI4/TdP8=";
        $SECRET_API_KEY = 'sk_test_g23ngmFeDgueS5qp';
        // Autenticación
        $culqi = new Culqi(array('api_key' => $SECRET_API_KEY));
       // dd($culqi);
        try{
            // Creamos Cargo a una tarjeta
            $cargo = $culqi->Charges->create(
                array(
                    "source_id"=>$token,
                    "currency_code"=> "PEN",
                    "amount"=> $celular->precio*100,
                    "description"=> $celular->marca." - ".$celular->titulo,
                    "email"=> $request->input('email'),

                    "antifraud_details" =>array(
                        "address"=> $request->input('address'),
                        "address_city"=> $request->input('address_city'),  
                        "country_code"=> "PE",
                        "first_name"=> $user->name,
                        "last_name"=> $user->lastname,
                        "phone_number"=> $request->input('phone_number'),
                    )
                )
            );
            echo "ok";
        } catch(Exception $e){

          $cargo2= $e->getMessage();
          echo json_encode($cargo2);
          return $cargo2;
        }

    }

}
/*Método que registra pago en base de datos*/
    public function regpago(Request $request){
        $user = Auth::user();
        $celulares = Celular::all();
        $id_producto=$request->input('id_producto');
        $celular=Celular::find($id_producto);
        
        $payment = new Payment();
        $payment->address = $request->address;
        $payment->address_city = $request->address_city;
        $payment->monto = $request->monto;
        $payment->phone_number = $request->phone_number;
        $payment->user_id = $user->id;
        $payment->save();
        
        return response()->json(['result'=>"success"]);    
    }


}


?>