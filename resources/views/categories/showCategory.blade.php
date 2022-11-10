<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- start alert message Delete   --}}
                @if (session()->has('delete'))
                    <div class="alert alert-danger">
                        {{ session()->get('delete') }}
                    </div>
                @endif
                {{-- End   alert   message Delete --}}
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <a class="modal-effect btn btn-outline-primary" href="{{ route('subCategories.create') }}"><i class=" fa fa-plus"></i>  Add Sub Category</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Sub Category Name</th>
                                    <th scope="col">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCats as $subCat)
                                    <tr>
                                        <th scope="row">{{$subCat->id}}</th>
                                        <td>{{$subCat->category_name}}</td>
                                        <td>{{$subCat->subCatName}}</td>
                                        <td>
                                            {{-- start update button  --}}
                                            <a class="btn btn-sm btn-info text-white" title="Update" href="{{ url('subCategories/edit/' . $subCat->id) }}">
                                                Update
                                            </a>
                                            {{-- End update button  --}}

                                            {{-- start Delete button  --}}
                                            <a class="btn btn-sm btn-danger" title="Delete" href="{{ url('subCategories/destroy/' . $subCat ->id) }}">
                                                Delete
                                            </a>
                                            {{-- End Delete button  --}}

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
