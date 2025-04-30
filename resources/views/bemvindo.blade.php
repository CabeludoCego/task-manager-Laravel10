Site

@auth
	<h1>Usuario autenticado.</h1>	
	<p>{{ Auth::user()->id }}</p>
	<p>{{ Auth::user()->name }}</p>
	<p>{{ Auth::user()->email }}</p>
	

@endauth

@guest
	guest user.	
@endguest