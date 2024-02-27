@foreach (explode(',',$model->role_name) as $role)
    <span class="badge badge-light">{{ $role }}</span>
@endforeach
