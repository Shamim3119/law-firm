<div style="width:400px;margin:50px auto;">
    <h2>Login</h2>

    @if (session()->has('error'))
        <div style="color:red">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="login">
        <input value="" type="email" wire:model="email" placeholder="Email"><br><br>
        <input value="" type="password" wire:model="password" placeholder="Password"><br><br>

        <button type="submit">Login</button>
    </form>
</div>