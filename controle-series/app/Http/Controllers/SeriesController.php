<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository) {}


    public function index(Request $request)
    {

        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = $this->repository->add($request);

        //enviar e-mail
        $email = new SeriesCreated(
            $serie->nome,
            $serie->id,
            $request->seasonQtd,
            $request->episodeQtd,

        );
        //enviar o email na hora da requisição
        Mail::to(Auth::user()->email)->send($email);

        //para colocar o email em uma fila para ser enviados apos a requisição
        //  Mail::to(Auth::user()->email)->queue($email);

        //para colocar o email em uma fila para ser enviados apos a requisição e espera o momento que ira ser execultado (Agendar o processamento para enviar os emails)
        
        // $when = now()->addSeconds(2); tempo que devera aguarda entre um email e outro
        // Mail::to(Auth::user()->email)->later($when, $email);


        //enviar para todos os usuarios do sistema

        //  $userList = User::all();
        //  foreach ($userList as $user) {
        //    $email = new SeriesCreated(
        //        $serie->nome,
        //        $serie->id,
        //       $request->seasonQtd,
        //        $request->episodeQtd,
        //    );
        //    Mail::to($user)->send($email);
        //  }
        //  sleep(2); cada e-mail ira ser enviado a cada 2 segundos


        return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series)
    {
        $series->delete();

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('Series', $series);
    }

    public function update(SeriesFormRequest $series, Request $request)
    {
        $series->update($request->all());
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' editada com sucesso");
    }
}
