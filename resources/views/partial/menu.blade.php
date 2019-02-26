@if(Auth::check())
<nav id="menu">
	<header class="major">
		<h2>Menu</h2>
	</header>
	<ul>
		<li><a href="{{URL('todo')}}">Task List</a></li>
		<li><a href="{{URL('logout')}}">Logout</a></li>
	</ul>
</nav>
@else
<section>
	<header class="major">
		<h2>Sign In</h2>
	</header>
	<div class="mini-posts">
		<form method="post" action="{{URL('authenticate')}}">
			@csrf
			<label>Email</label>
			<input type="text" name="email" placeholder="Email">
			@if (session('notification'))
			<span class="help-block">
                <strong>{{ session('notification') }}</strong>
            </span>
            @endif
			<label>Passsword</label>
			<input type="password" name="password" placeholder="Password">
		
	</div>
	<ul class="actions">
		<li><button href="#" class="button">Sign In</button></li>
	</ul>
	</form>
</section>
@endif