<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                @foreach ($configurations as $index => $configuration)
                <p>{{$configuration->name }}</p>
                <p>{{$configuration->address }}</p>
                <p>{{$configuration->phone }}</p>
                @endforeach
            </div>
            <div class="col-lg-6">
                @foreach ($configurations as $index => $configuration)
                <p>Copyright &copy; 2024 {{$configuration->name }}
		@endforeach
                <br>Designed by <a rel="nofollow" href="https://templatemo.com" class="tm-text-link" target="_parent">TemplateMo</a></p>
		<p>Distributed by <a rel="nofollow" href="https://themewagon.com" class="tm-text-link" target="_blank">ThemeWagon</a></p>
            </div>
        </div>
    </div>
</footer>
