<!--begin: Pic-->
<div class="me-7 mb-4">

    @php
        $media = getUserImage($user->getAvatarPath());
    @endphp
    <div
        class="user-avatar-input-container image-input image-input-outline image-input-placeholder mb-3 {{ !empty($media) ? 'image-input-change' : 'image-input-empty' }}">
        <!--begin::Preview existing avatar-->
        <div class="image-input-wrapper w-150px h-150px"
             style="background-image: {{empty($media) ? 'none' : 'url("'.asset($media).'")'}}"
             data-bs-toggle="tooltip" title="{{__('cpanel.Click on the pencil icon to select or change the image.')}}">
        </div>
        <!--end::Preview existing avatar-->
        @can("user_profile_change_avatar")
            <!--begin::Label-->
            <label
                class="btn btn-icon btn-circle bg-primary btn-color-light w-25px h-25px bg-body shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                title="{{!empty($media) ? __('cpanel.change image') : __('cpanel.select image')}}"
                data-kt-initialized="1">
                <i class="bi bi-pencil-fill fs-7"></i>
                <!--begin::Inputs-->
                <input type="file" name="avatar" accept=".jpg,.jpeg,.png">
                <!--end::Inputs-->
            </label>
            <!--end::Label-->
        @endcan


        <!--begin::Cancel-->
        <span
            class="btn btn-icon btn-circle bg-danger btn-color-light w-25px h-25px bg-body shadow"
            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
            aria-label="Cancel avatar" data-bs-original-title="Cancel avatar"
            data-kt-initialized="1">
            <i class="bi bi-x fs-2"></i>
        </span>
        <!--end::Cancel-->
        @can("user_profile_remove_avatar")
            <!--begin::Remove-->
            <span
                class="btn btn-icon btn-circle bg-danger btn-color-light w-25px h-25px bg-body shadow"
                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                aria-label="Remove avatar" data-bs-original-title="Remove avatar"
                data-kt-initialized="1">
                <i class="bi bi-x fs-2"></i>
            </span>
            <!--end::Remove-->
        @endcan
        <!--begin::apply`-->
        <span
            class="btn btn-icon btn-circle bg-primary btn-color-light w-25px h-25px bg-body shadow d-none"
            data-kt-image-input-action="apply" data-bs-toggle="tooltip"
            aria-label="{{__('cpanel.save')}}" data-bs-original-title="{{__('cpanel.save')}}"
            data-kt-initialized="1">
            <i class="bi bi-check fs-2"></i>
        </span>
        <!--end::apply-->
    </div>
</div>
<!--end::Pic-->


