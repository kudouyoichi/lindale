<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				 <span class="sr-only">Toggle navigation</span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">
			Lindalë
			</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="{{ url('/admin') }}"><span class="glyphicon glyphicon-home"></span></a>
				</li>
				@if (Auth::guest())
				@else
				<li>
					<a href="#">建设中</a>
				</li>
				<li class="dropdown">
					 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
					<ul class="dropdown-menu">
						<li>
							<a href="#">Action</a>
						</li>
						<li>
							<a href="#">Another action</a>
						</li>
						<li>
							<a href="#">Something else here</a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="#">Separated link</a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="#">One more separated link</a>
						</li>
					</ul>
				</li>
			</ul>
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<input type="text" class="form-control" />
				</div>
				<button type="submit" class="btn btn-default">
					Submit
				</button>
			</form>
			@endif
			<ul class="nav navbar-nav navbar-right">
				@if (Auth::guest())
				@else
					<li>
						<a href="#">建设中</a>
					</li>
					<li class="dropdown">
						 <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}<strong class="caret"></strong></a>
						<ul class="dropdown-menu">
							<li>
								<a href="#">Action</a>
							</li>
							<li>
								<a href="#">Another action</a>
							</li>
							<li>
								<a href="#">Something else here</a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="{{ url('/admin/logout') }}">Logout</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>