<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = [
            ['id' => 1, 'name' => "Maria Silva", 'email' => "maria@exemplo.com", 'active' => true, 'initials' => "M"],
            ['id' => 2, 'name' => "João Santos", 'email' => "joao@exemplo.com", 'active' => true, 'initials' => "J"],
            ['id' => 3, 'name' => "Ana Oliveira", 'email' => "ana@exemplo.com", 'active' => false, 'initials' => "A"],
            ['id' => 4, 'name' => "Pedro Costa", 'email' => "pedro@exemplo.com", 'active' => false, 'initials' => "P"],
            ['id' => 5, 'name' => "Lúcia Ferreira", 'email' => "lucia@exemplo.com", 'active' => false, 'initials' => "L"]
        ];

        $recentMessages = [
            ['author' => "Pedro Costa", 'text' => "Gostaria de solicitar o cancelamento...", 'date' => "21 mai", 'avatar' => "P"],
            ['author' => "Maria Silva", 'text' => "Olá! Gostaria de saber mais...", 'date' => "21 mai", 'avatar' => "M"],
            ['author' => "João Santos", 'text' => "Estou tentando acessar minha conta...", 'date' => "21 mai", 'avatar' => "J"],
            ['author' => "Ana Oliveira", 'text' => "Quero parabenizar a equipe...", 'date' => "21 mai", 'avatar' => "A"]
        ];

        return view('pages.dashboard', [
            'totalUsers' => count($users),
            'activeUsers' => count(array_filter($users, fn($u) => $u['active'])),
            'pendingUsers' => count(array_filter($users, fn($u) => !$u['active'])),
            'newMessages' => 0,
            'recentUsers' => array_reverse($users),
            'recentMessages' => $recentMessages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login()
    {
        return view('pages.login');
    }

    public function register()
    {
        return view('pages.register');
    }

}
