<div class="tab-content" id="profile-tab-content">
    @foreach($tabs as $id => $tab)
        @can($tab['can'])
            <div id="{{$id}}" class="tab-pane fade show {{$tab['default'] ? "active" : ""}}" role="tabpanel">
                <div class="card mb-5 mb-xl-10" id="{{$id}}">
                    @include("pages.user-profile.tabs.$id-view",get_defined_vars())
                </div>
            </div>
        @endcan
    @endforeach
</div>
