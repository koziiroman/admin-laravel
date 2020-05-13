@extends('backend.layouts.app')

@section('content')
    <x-forms.post :action="route('admin.auth.role.store')">
        <x-backend.card>
            <x-slot name="header">
                {{ __('Create Role') }}
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.role.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <x-forms.group for="name" :label="__('Name')">
                    <x-forms.text name="name" :placeholder="__('Name')" :value="old('name')" required />
                </x-forms.group>

                @include('backend.auth.role.includes.permissions')
            </x-slot>

            <x-slot name="footer">
                <x-forms.submit :text="__('Create Role')" />
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
