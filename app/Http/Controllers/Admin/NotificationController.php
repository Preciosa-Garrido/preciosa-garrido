<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.notifications.index', ['notifications' => Notification::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);

        if($notification->fill(['status' => 1])->update())
            return redirect()->back()->with('mensagem', 'Notificação actualizada');

        return redirect()->back()->with('mensagem', 'Erro ao actualizar notificação');        
    }

    public function seen()
    {
        return view('admin.notifications.index', ['notifications' => Notification::whereStatus(1)->get()]);
    }

    public function notseen()
    {
        return view('admin.notifications.index', ['notifications' => Notification::whereStatus(0)->get()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Notification::destroy($id))
            return redirect()->back()->with('mensagem', 'Notificação apagada');

        return redirect()->back()->with('mensagem', 'Erro ao apagar notificação');
    }
}
