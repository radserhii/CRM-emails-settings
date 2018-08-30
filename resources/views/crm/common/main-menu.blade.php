<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <a class="navbar-brand" href="/">ExpoCRM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-link" href="/">Dashboard</a>
            </li>
            <li class="nav-item {{ request()->segment(1) === 'traders' ? 'active' : null }}">
                <a class="nav-link" href="{{route('crm.traders')}}">Traders</a>
            </li>
            <li class="nav-item {{ request()->segment(1) === 'emails' ? 'active' : null }}">
                <a class="nav-link" href="{{route('crm.emails')}}">E-mail</a>
            </li>
        </ul>
    </div>
</nav>