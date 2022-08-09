<div id="card-user" class="col-md-4">
    <div class="card" style="width: 18rem;">
        <div class="text-center mt-4">
            @guest @if (Route::has('register'))
            <h5>Guest</h5>
            <p class="text-secondary">guest@email.com</p>
            @endif @else
            <h5>{{ Auth::user()->name }}</h5>
            <p class="text-secondary">{{ Auth::user()->email }}</p>
            @endguest
        </div>
        <div id="nav-account">
            <div class="list-group">
                <a class="list-group-item list-group-item-action{{ request()->is('myaccount') ? ' active' : '' }}" href="{{ url('/myaccount') }}">My Account</a>
                <a class="list-group-item list-group-item-action{{ request()->is('myorders') ? ' active' : '' }}" href="{{ url('/myorders') }}">My Orders</a>
                @guest @if(Route::has('register'))
                <a class="list-group-item list-group-item-action{{ request()->is('myaccount/{user:id}/edit') ? ' active' : '' }}" href="{{ url('login') }}">Edit My Account</a>
                @endif @else
                <a class="list-group-item list-group-item-action{{ request()->is('myaccount/{user:id}/edit') ? ' active' : '' }}" href="/myaccount/{{Auth::user()->id}}/edit">Edit My Account</a>
                <a class="list-group-item list-group-item-action{{ request()->is('myaccount/{user:id}/edit-password') ? ' active' : '' }}" href="/myaccount/{{Auth::user()->id}}/edit-password">Change Password</a>
                @endguest
            </div>
        </div>
    </div>
</div>