<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SeriesController extends Controller
{
  public function index(): Response
  {
      return response(Serie::all(), Response::HTTP_OK);
  }

  public function store(Request $request): Response
  {
    $serieCadastrada = Serie::create($request->all());
    return response($serieCadastrada, 201);
  }

  public function show($id): Response
  {
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id === false) {
      return response('Not Found', 404);
    }

    $serie = Serie::findOrFail($id);
    return response($serie, 200);
  }

  public function edit($id)
  {
      //
  }

  public function update(Request $request, $id)
  {
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id === false) {
      return response('Not found', 404);
    }
    $serie = Serie::find($id);
    if (isset($request['nome'])) {
          $serie->nome = $request['nome'];
    }
    if (isset($request['categoria'])) {
          $serie->categoria = $request['categoria'];
    }
    if (isset($request['streaming'])) {
          $serie->streaming = $request['streaming'];
    }
    if (isset($request['status'])) {
              $serie->status = $request['status'];
    }
    $serie->save();

    return response('No Content', 204);
  }



  public function status($id): Response
  {
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id === false) {
      return response('Not found', 404);
    }
    $serie = Serie::find($id);
    if ($serie->status === 'não-assistido') {
      $serie->status = 'assistido';
    }
    else {
      $serie->status = 'não-assistido';
    }
    $serie->save();
    return response('No Content', 204);
  }

  public function destroy($id): Response
  {
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id === false) {
      return response('Not Found', 404);
    }

    Serie::destroy($id);
    return response('Ok', 200);
  }
}
