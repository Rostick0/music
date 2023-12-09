@extends('layout.client.index')

@section('html')
    <div class="container">
        <div id="licenses" class="content">
            <h2>License</h2>
            <div class="pre-table">
                <table class="licenses-table">
                    <thead>
                        <tr>
                            <th>Автор - Track</th>
                            <th>License code</th>
                            <th>Email</th>
                            <th>Date created</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Здесь будут строки, заполненные сервером -->
                        @foreach ($licenses as $license)
                            <tr>
                                <td>{{ $license?->licensesable?->author }} {{ $license?->licensesable?->title }}</td>
                                <td>{{ $license->code }}</td>
                                <td>{{ $license->user->email }}</td>
                                <td>{{ date('d.m.Y', strtotime($license->created_at)) }}</td>
                                <td><a class="admin-button admin-button-gradient"
                                        href="{{ route('client.license.show', [
                                            'id' => $license->id,
                                        ]) }}">Download</a>
                                </td>
                            </tr>
                        @endforeach
                        <!-- Повторение строк для каждой лицензии -->
                    </tbody>
                </table>
            </div>
            <br>
            {{ $licenses->links('vendor.front-pagination') }}
        </div>
    </div>
@endsection
