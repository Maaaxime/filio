<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies Management') }}
        </h2>
    </x-slot>

    <x-banner />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="pull-right">
                        @can('company-mngt')
                        <a class="btn btn-success" href="{{ route('companies.create') }}">+ Create New company</a>
                        @endcan
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $key => $company)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <a class="btn btn-info"
                                        href="{{ route('companies.show',$company->id) }}">{{ $company->name }}</a></td>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @can('company-mngt')
                                    <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>
                                    {!! Form::open(['method' => 'DELETE','route' =>
                                    ['companies.destroy',$company->id],'style'=>'display:inline'])!!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {!! $companies->render() !!}

</x-app-layout>
