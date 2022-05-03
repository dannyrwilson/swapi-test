@extends('layout_template')

@section('body_contents')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">

				@if($people !== false)
					<p class="alert alert-info">Total of {{ $people['count'] }} people</p>

					<form method="get" action="/people">
						<div class="card mb-2">
							<div class="card-header">
								Perform Search
							</div>
							<div class="card-body">
								<div class="form-group">
									<input type="hidden" name="page" value="1" />
									<input class="form-control mb-2" name="search" placeholder="Enter search term..." value="{{ $keyword }}" />
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</form>
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<!-- birth_year, eye_color hair_color, height, mass, skin_color -->
									<th>Person</th>
									<th>Birth Year</th>
									<th>Eye Colour</th>
									<th>Hair Colour</th>
									<th>Skin Colour</th>
									<th>Height</th>
									<th>Mass</th>
									<th>Total Films</th>
									<th>Total Species</th>
									<th>Total Starships</th>
									<th>Total Vehicles</th>
								</tr>
							</thead>
							<tbody>

								@if($people['count'] === 0)
									<tr>
										<td colspan="12" class="text-center">
											No results available.
										</td>
									</tr>
								@else
									@foreach($people['results'] as $person)

										<tr>
											<td>{{ $person['name'] }}</td>
											<td>{{ $person['birth_year'] }}</td>
											<td>{{ $person['eye_color'] }}</td>
											<td>{{ $person['hair_color'] }}</td>
											<td>{{ $person['skin_color'] }}</td>
											<td>{{ $person['height'] }}</td>
											<td>{{ $person['mass'] }}</td>
											<td>{{ count($person['films']) }}</td>
											<td>{{ count($person['species']) }}</td>
											<td>{{ count($person['starships']) }}</td>
											<td>{{ count($person['vehicles']) }}</td>
											<!-- <td>
												<a href="{{ route('personView', $person['id']) }}" class="btn btn-md btn-primary">View</a>
											</td> -->
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>


					<nav aria-label="People navigation">
					  <ul class="pagination">
					  	@for ($i=0; $i < $pages['totalPages']; $i++)
					    <li class="page-item {{ ($pages['page'] == $i+1) ? 'active' : '' }}"><a class="page-link" href="/people?page={{$i+1}}&amp;search={{$keyword}}">{{$i+1}}</a></li>
					    @endfor
					  </ul>
					</nav>


				@else
					API down, throw a generic message.
				@endif
			</div>
		</div>
	</div>
@endsection