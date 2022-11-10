<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sub Category Add') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- start alert message Add Success   --}}
            @if (session()->has('Add'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('Add') }}
                </div>
            @endif
            {{-- start alert message Error   --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- End   alert   message Error --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <h1 class="text-primary text-center text-md">Add Sub Category</h1>
                        <form action="{{route('subCategories.store')}}" method="post" >
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label for="exampleInputCat" class="form-label">Sub Category Name</label>
                                <input type="text" class="form-control" id="exampleInputCat" name="subCatName">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputCat" class="form-label">Category Name</label>
                                <select class="form-select" aria-label="Default select example" name="category">
                                    <option selected disabled>Choose Category</option>
                                    @foreach ($cats as $cat )
                                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
