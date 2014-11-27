@extends('admin.index')
	
@section('content')
    <div class="row">
	    <div class="col-md-12">
	    
	    	<div class="panel panel-default">
	
				<div class="panel-heading">
					<h3 class="panel-title">Исполнители</h3>
					<small class="hide">колл. найденых исполнителей 100</small>
				</div>
				
				<div class="panel-body">
					
					<div class="btn-group pull-right">
						<a href="#artists_filter" data-toggle="modal" class="btn btn-info btn-sm">Поиск</a>			
						<a href="/admin/artists/form" type="button" class="btn btn-primary btn-sm">Добавить исполнителя</a> 
					</div>
					
					<table class="table table-hover">
					
						<thead>
							<tr>
								<th><a href="" class="text-muted">ID</a></th>
								<th><a href="" class="text-muted">Название исполнителя</a></th>
								<th><a href="" class="text-muted">Админитраторы</a></th>
								<th><a href="" class="text-muted">Ссылка на страницу</a></th>
								<th><a href="" class="text-muted">Дата регистрации</a></th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach($artists as $artist)
								<tr>
									<td>{{ $artist->id }}</td>
									<td>{{ $artist->name }}</td>
									<td>admin</td>
									<td>link</td>
									<td>{{ $artist->created_at }}</td>
									<td class="text-right">
										
										<a href="#" class="tooltip_top_menu" data-toggle="tooltip" data-placement="top" title="Написать сообщение"><span class="fa fa-comments-o"></span></a>
										&nbsp;
										<a href="#" class="tooltip_top_menu" data-toggle="tooltip" data-placement="top" title="Просмотреть"><span class="fa fa-eye"></span></a>
										&nbsp;
										<a href="/admin/artists/form/{{ $artist->id }}" class="tooltip_top_menu" data-toggle="tooltip" data-placement="top" title="Редактировать"><span class="fa fa-pencil-square-o text-success"></span></a>
										&nbsp;
										<a href="/admin/artists/destroy/{{ $artist->id }}" class="tooltip_top_menu" data-toggle="tooltip" data-placement="top" data-confirm="Вы действительно хотите удалить ?" title="Удалить"><span class="fa fa-trash-o text-danger"></span></a>
										&nbsp;
										
									</td>
								</tr>
							@endforeach
						</tbody>
						
					</table>
					
				</div>
				
			</div>
			
			<div class="text-center">Pagination</div>
			
	    </div>
	    
    </div>
@stop	