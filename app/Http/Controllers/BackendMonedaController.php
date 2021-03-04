<?php

namespace App\Http\Controllers;
use App\Models\Moneda;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class BackendMonedaController extends Controller
{
    
     public function index(Request $request)
    {
        
        $token = csrf_token();
        $monedas = $this->getPage($request, $request->input('page'));
        //$monedas = Moneda::paginate(3);
        return response()->json(['monedas' => $monedas, 'token' => $token]);
    }

    private function getPage(Request $request, $page = 1) {
        $currentPage = $page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        $monedas = Moneda::paginate(3);
        $page = $monedas->currentPage();
        $lastPage = $monedas->lastPage();
        if($page > $lastPage) {            
            $currentPage = $lastPage;
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
            $monedas = Moneda::paginate(3);
        }
        return $monedas;
    }
    
    
      public function show($moneda)
    {
        $moneda = Moneda::find($moneda);
        return response()->json(['moneda' => $moneda]);
    }


    public function edit($moneda)
    {
        $moneda = Moneda::find($moneda);
        return view('backend.moneda.edit', ['moneda' => $moneda]);
    }    
    
    public function update(Request $request, $id)
    {
        $moneda = Moneda::find($id);
        
        try{
            $result = $moneda->update($request->all());    
        }catch(\Exception $e){
            $result = $e;            
        }        

        return response()->json(['result' => $result, 'moneda' => $moneda]);
    }
    
      public function create()
    {
        return view('backend.moneda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
          $moneda = new Moneda($request->all());
          try{
              $result = $moneda->save();
          }catch(\Exception $e){
              $result  = $e;
              dd($result);
          }
        
        if($moneda->id > 0){

            $result = $moneda->save();
            $response = ['moneda' => $moneda];
            return response()->json($response);
        } else {
            return response()->json(['error' => 'La entrada esta duplicada']);
        }
    }
    
    public function destroy(Request $request, $id)
    {
        $moneda = Moneda::find($id);
        
        try{
            $result = $moneda->delete();    
        }catch(\Exception $e){
            $result = 0;
        }
        $monedas = $this->getPage($request, $request->input('_page'));
        $monedas->setPath(url('ajaxmoneda'));
        return response()->json(['monedas' => $monedas, 'result' => $result]);
        
    }
    
}
