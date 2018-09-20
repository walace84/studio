<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Order;
use App\Model\Client;
use App\Model\OrderProd;
use App\Model\Report;
use Illuminate\Support\Facades\Input;
use Session;
use DB;

class CartController extends Controller
{
    // lista os clientes para add na sessão
    public function list()
    {
        $client = Client::ClientList(5);
        return view('cart.client',compact('client'));
    }

    // listProd
    public function listProd()
    {
        $products = Product::ClientProd();
        return view('cart.product', compact('products'));
    }
    
    // Lista o item do usuário escolhido
    public function index(Request $request)
    {
       
        if ($request->session()->has('client')) {
            $users = Session::get('client');
            $orders = Order::where([
                'status'    => 'RE',
                'client_id' => $users->id,
            ])->get();

            $pontos = DB::table('order_prods')->select('points')->where('client_id', '=', $users->id)->get();

            $qtd = $pontos->sum('points');
        }

        return view('cart.index', compact('users', 'orders', 'qtd'));
    }

    public function addCart(Request $request)
    {
       // Pega a sessão do cliente 
       $users = Session::get('client');
       // se tentar add um produto sem cliente.
       if(isset($users) < 1){
          return redirect()->route('cart')->with('message', 'VOCÊ PRECISA ESCOLHER UM CLIENTE.');
       }
       // faz uma consulta para verificar se existe um pedido em aberto 
       $idOrder = Order::queryid([
        'client_id' => $users->id,
        'status'  => 'RE'
       ]);
       // se não existir pedido em aberto crie um 
       if(empty($idOrder)){
          $NewOrder = Order::create([
                'client_id' => $users->id,
                'status'    => 'RE',
            ]);  
          $idOrder = $NewOrder->id;  
       }
       // pega os dados do produto e cria na ordens de produtos
       $id = $request->input('id');
       $product = Product::find($id);
      
       OrderProd::create([
           'price'       => $product->price,
           'product_id'  => $product->id, 
           'status'      => 'RE',
           'order_id'    => $idOrder,
           'product'     => $product->product,
           'client_id'   => $users->id,
           'points'      => $product->points,
           'discount'    => 0, 
       ]);
       
       return redirect()->route('cart');
       
    }

    public function remove(Request $request)
    {
        $req = $request->all(); 
        // pega o id do produto e o id da order
        $idOrder           = $req['order'];
        $product_id        = $req['product_id'];
        $remove_item       = (boolean)$req['item'];

        $users = Session::get('client');

        $idOrder = Order::queryid([
            'id'        => $idOrder,   
            'client_id' => $users->id,
            'status'    => 'RE'
        ]);
        // atribui aos indices     
        $where_product = [
            'order_id'   => $idOrder,
            'product_id' => $product_id,
        ];
        // faz a pesquisa com o id do produto e o id da ordem para verificar se existe
        $product = OrderProd::where($where_product)->orderBy('id', 'DESC')->first();
        if(empty($product->id)){
            return redirect()->back();
        }
        // ao fazer a consulta o $product fica com um id.
        if($remove_item){
            $where_product['id'] = $product->id;
        }
        // deleta o produto pelo id.
        OrderProd::where($where_product)->delete();

        // verifica se existe mais algum produto vinculado a este pedido retorna um boolean
        $check_order = OrderProd::where([
            'order_id' => $product->order_id,
        ])->exists();

        // caso não tenha mais produtos nesse pedido, ele deleta o pedido da tabela order
        if(!$check_order){
            Order::where([
                'id' => $product->order_id,
            ])->delete();
        }

        return redirect()->route('cart');

    }


    // fechar a venda
    public function closeOrder(Request $request)
    {

        $users = Session::get('client');
        $idOrder = $request->input('order_id');
       
        // faz uma consulta na tabela de orders
        $check_order = Order::where([
            'id'         => $idOrder,
            'client_id'  => $users->id,
            'status'     => 'RE',
        ])->exists();
         
        if(!$check_order){
            return redirect()->route('cart');
        }
        // verifica se existe essa order na tabela OrderProd 
        $check_product = OrderProd::where([
            'order_id'  => $idOrder,
        ])->exists();

        if(!$check_product){
            return redirect()->route('cart');
        }
        // Se existir na tabela orderProd esse id de order atualize ele
        OrderProd::where([
            'order_id'=> $idOrder, 
        ])->update([
            'status' => 'PA',
        ]);
        // se o id que estiver vindo, for o mesmo da tabela order atualize    
        Order::where([
            'id' => $idOrder,    
        ])->update([
            'status' => 'PA',
        ]);  

        // GRAVA NA TABELA REPORT
       $report = DB::table('order_prods')->where('order_id', '=', $idOrder)->get();
       
        foreach($report as $value){
           // pega o preço subtrai o desconto e grava no report 
           $total = $value->price - $value->discount;

           Report::create([
              'total'      => $total,
              'product_id' => $value->product_id,
              'status'     => 'PA',
              'client_id'  => $users->id, 
              'prodname'   => $value->product,
              'order_id'   => $idOrder,
           ]);
        }  

        // busca o cliente para fazer uma atualização nos seus créditos
        $client = Client::where([
            'id' => $users->id
        ])->get();
        // pega a tabela reports que tem o valor já com descontos para atualizar os créditos do cliente.    
        $discount = DB::table('reports')->where('order_id', '=', $idOrder)->sum('total');

        foreach($client as $user){

           if($user->credits >= 0){
                 $credits =  $user->credits - $discount;
                // atualiza o cliente toda vez que ele fizer uma compra
                Client::where([
                    'id'=> $users->id, 
                ])->update([
                    'updated_at' => date('Y-m-d'),
                    'credits'    => $credits,
                ]); 

           } else {

                $credits =  $user->credits;

                Client::where([
                    'id'=> $users->id, 
                ])->update([
                    'updated_at' => date('Y-m-d'),
                    'credits'    => $credits,
                ]); 

           }
               
                return redirect()->route('points')->with('message', 'VENDA FINALIZADA COM SUCESSO!.');

        }

          

    }

    // faz uma pesquisa dos pontos do cliente
    public function points()
    {
        $users = Session::get('client');
        if(isset($users) < 1){
            return redirect()->back()->with('message', 'PARA VER A PONTUAÇÃO É PRECISO SELECIONAR UM CLIENTE.');
        }

        $pontos = DB::table('order_prods')->select('points')->where('client_id', '=', $users->id)->get();

        $qtd = $pontos->sum('points');
    
        return view('cart.points', compact('qtd', 'users'));
    }

    // deleta os pontos do cliente
    public function deletePoints()
    {
        $users = Session::get('client');

        if(isset($users) < 1){
            return redirect()->back();
        }
        
        $id = DB::table('orders')->where('client_id' , '=', $users->id)->delete();
        
        return redirect()->back()->with('message', 'OS PONTOS FORAM ZERADOS!');
        
    }

    // descontos
    public function discount(Request $request, $id)
    {
        $req = $request->all();

        $req['discount'] = str_replace(',','.',str_replace('.','',$req['discount'])); 

        $idOrder    = $req['order_id'];
        $discount   = $req['discount'];
        $users = Session::get('client');

        if($discount == ''){
            return redirect()->back()->with('message', 'VALOR INVÁLIDO!');
        }

        // verifica se ainda está em aberto
        $check_order = Order::where([
            'id'         => $idOrder,
            'client_id'  => $users->id,
            'status'     => 'RE',
        ])->exists();

        if(!$check_order){
            return redirect()->route('cart')->with('message', 'PEDIDO NÃO ENCONTRADO');
        }

        $order = OrderProd::where([
            'order_id' => $idOrder, 
            'status'   => 'RE'
        ])->get();
       
        $aplic_discount = false;

        foreach($order as $order_prod){
           
            $order_prod->discount =  ($order_prod->price * $discount) / 100;
          
            $order_prod->update();
            $aplic_discount = true;
        }

        if($aplic_discount){
            return redirect()->route('cart')->with('message', 'DESCONTO APLICADO');
        }
        return redirect()->route('cart');
    }

    // barra de pesquisa
    public function search()
    {
        $search = Input::get('name');
       
        if($search != ''){
            $client = Client::where('name', 'LIKE', "%$search%")->orderByRaw('name', '=', 'ASC')->paginate(5);
            if(isset($client) > 0){
                return view('cart.client', compact('client'));
            }else{
                $client = Client::ClientList(5);
                return view('cart.client', compact('client'));
            }
        }else{
            $client = Client::ClientList(5);
            return view('cart.client', compact('client'));
        }
    }

}
