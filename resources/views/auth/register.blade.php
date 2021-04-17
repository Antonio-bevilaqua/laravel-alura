<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nome')" />

                <?php $classInput = "block mt-1 w-full"; 
                if ($errors->first("name") !== ""){
                    $classInput = "block mt-1 w-full border-red-600"; 
                } ?>
                <x-input id="name" class="<?php echo $classInput; ?>" type="text" name="name"
                    :value="old('name')" required autofocus />
                @error('name')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <?php $classInput = "block mt-1 w-full"; 
                if ($errors->first("email") !== ""){
                    $classInput = "block mt-1 w-full border-red-600"; 
                } ?>
                <x-input id="email" class="<?php echo $classInput; ?>" type="email"
                    name="email" :value="old('email')" required />
                @error('email')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Senha')" />
                <?php $classInput = "block mt-1 w-full"; 
                if ($errors->first("password") !== ""){
                    $classInput = "block mt-1 w-full border-red-600"; 
                } ?>
                <x-input id="password" class="<?php echo $classInput; ?>" type="password"
                    name="password" required autocomplete="new-password" />
                @error('password')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar Senha')" />
                <?php $classInput = "block mt-1 w-full"; 
                if ($errors->first("password_confirmation") !== ""){
                    $classInput = "block mt-1 w-full border-red-600"; 
                } ?>
                <x-input id="password_confirmation"
                    class="<?php echo $classInput; ?>" type="password"
                    name="password_confirmation" required />
                @error('password_confirmation')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Já é cadastrado?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Cadastrar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
