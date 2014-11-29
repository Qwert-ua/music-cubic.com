@extends('admin.index')
	
@section('content')
    <div class="row">
	    <div class="col-md-12">
	    
	    	<div class="panel panel-default">
	
				<div class="panel-heading">
					<h3 class="panel-title">Список пользователей</h3>
					<small class="hide">колл. найденых пользователей 100</small>
				</div>
				
				<div class="panel-body">
					
					<div class="btn-group pull-right">
						<a href="#user_filter" data-toggle="modal" class="btn btn-info btn-sm">Поиск</a>			
						<a href="/admin/users/form" type="button" class="btn btn-primary btn-sm">Добавить пользователя</a> 
					</div>
				
					<ul class="nav nav-tabs" role="tablist">
						@foreach($roles as $role)
							<li
								@if($role->id == $role_id)
									class="active"
								@endif
							><a href="/admin/users/{{ $role->id }}">{{ $role->description }}</a></li>
						@endforeach 
					</ul>
					
					<table class="table table-hover">
					
						<thead>
							<tr>
								<th><a href="" class="text-muted">ID</a></th>
								<th><a href="" class="text-muted">ФИО</a></th>
								<th><a href="" class="text-muted">Электроный адрес</a></th>
								<th><a href="" class="text-muted">День рождения</a></th>
								<th><a href="" class="text-muted">Дата регистр.</a></th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach($users as $user)
								@if($user->username != 'admin')
								<tr>
									<td>{{ $user->id }}</td>
									<td>{{ $user->firstname }} {{ $user->lastname }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->birthday }}</td>
									<td>{{ $user->created_at }}</td>
									<td class="text-right">
										
										<a href="#" class="tooltip_top_menu" data-toggle="tooltip" data-placement="top" title="Написать сообщение"><span class="fa fa-comments-o"></span></a>
										&nbsp;
										<a href="#" class="tooltip_top_menu" data-toggle="tooltip" data-placement="top" title="Просмотреть"><span class="fa fa-eye"></span></a>
										&nbsp;
										<a href="/admin/users/form/{{ $user->id }}" class="tooltip_top_menu" data-toggle="tooltip" data-placement="top" title="Редактировать"><span class="fa fa-pencil-square-o text-success"></span></a>
										&nbsp;
										<a href="/admin/users/destroy/{{ $user->id }}" class="tooltip_top_menu" data-toggle="tooltip" data-placement="top" data-confirm="Вы действительно хотите удалить ?" title="Удалить"><span class="fa fa-trash-o text-danger"></span></a>
										&nbsp;
							
										@if($user->active == 1)
											<a href="#block" data-toggle="modal" class="tooltip_top_menu block_user" data-toggle="tooltip" data-placement="top" title="Блокировать" data-id="{{ $user->id }}"><span class="fa fa-unlock-alt" style="color: #a9a9a9"></span></a>
										@else	
											<a href="/admin/users/unblock/{{ $user->id }}" class="tooltip_top_menu" data-toggle="tooltip" data-placement="top" title="Разблокировать"><span class="fa fa-lock text-warning"></span></a>
										@endif
										
									</td>
								</tr>
								@endif
							@endforeach
						</tbody>
						
					</table>
					
				</div>
				
			</div>
			
			<div class="text-center">Pagination</div>
			
	    </div>
	    
    </div>
@stop	