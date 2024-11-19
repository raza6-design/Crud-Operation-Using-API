@extends('layout')
@section('title')
Detail   
@endsection
@section('head')
 Detail Post
@endsection
@section('sub-head')
 Complete detail of post
@endsection
@section('content')
     <div class="table">
            <table>
                <thead >
                    <tr>
                        <th >Title</th>
                        <th>Description</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($users as $user) --}}
                    <tr>
                        <td>Title Post One</td>
                        <td>Description of post one</td>
                        <td>Post one Image.JPG</td> 
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
        <div class="back-btn">
            <a href="">Back</a>
        </div>
@endsection

       