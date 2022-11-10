<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category System') }}
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
                        <a class="modal-effect btn btn-outline-primary" href="{{ route('categories.create') }}"><i class=" fa fa-plus"></i>  Add Category</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cats as $category)
                                    <tr>
                                        <th scope="row">{{$category->id}}</th>
                                        <td>{{$category->category_name}}</td>
                                        <td>{{$category->created_by}}</td>
                                        <td>

                                            {{-- Start View button  --}}
                                            <a class="btn btn-sm btn-primary text-white" title="View" href="{{ url('categories/show/' . $category ->id) }}">
                                                View
                                            </a>
                                            {{-- End View button  --}}
                                            
                                            {{-- start update button  --}}
                                            <a class="btn btn-sm btn-info text-white" title="Update" href="{{ url('categories/edit/' . $category ->id) }}">
                                                Update
                                            </a>
                                            {{-- End update button  --}}

                                            {{-- start Delete button  --}}
                                            <a class="btn btn-sm btn-danger" title="Delete" href="{{ url('categories/destroy/' . $category ->id) }}">
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
