@extends('base')

@section('content')
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img class="connexion-logo" src="{{ asset('./images/logoFixe.png') }}" alt="Logo Fishouse">
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-jet-label for="firstname" value="{{ __('Prénom') }}"/>
                <x-jet-input id="firstname" class="block mt-1 w-full" type="text" name="firstname"
                             :value="old('firstname')" required autofocus autocomplete="Jean"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="lastname" value="{{ __('Nom') }}"/>
                <x-jet-input id="lastname" class="block mt-1 w-full" type="text" name="lastname"
                             :value="old('lastname')" required/>
            </div>

            <div class="mt-4">
                <x-jet-label for="username" value="{!! __('Nom d\'utilisateur') !!}"/>
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username"
                             :value="old('username')" required/>
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}"/>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required/>
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Mot de passe') }}"/>
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                             autocomplete="new-password"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmation du mot de passe') }}"/>
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                             name="password_confirmation" required autocomplete="new-password"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="expert">
                    <div class="flex items-center">
                        <x-jet-checkbox name="expert" id="expert" value="1" />

                        <div class="ml-2">
                            {!! __('Etes-vous un expert ?') !!}
                        </div>
                    </div>
                </x-jet-label>
            </div>

            <div class="mt-4" id="expert_file_upload">
                <x-jet-label for="expert_file" value="{!! __('Justificatif d\'expert') !!}" />
                <x-jet-input id="expert_file" class="block mt-1 w-full" type="file" name="expert_file" />
            </div>

            <div class="flex items-center justify-end mt-5">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Déjà inscrit ?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('S\'inscrire') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
@endsection
