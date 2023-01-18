<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="participate" id="participate" style="margin: 25px 0">
                    <h4 class="section-title">Participate <span>in</span> giveaway, you can <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#createModal" data-bs-whatever="@mdo">Create</button> another one!</h4>
                    <div class="participate-container">
                        <div class="participate-row" style="justify-content: center; align-items: center; flex-wrap: wrap">
                            @if (count($keys))
                                @foreach ($keys as $key)
                                    <div class="participate-item">
                                        <img src="https://chart.googleapis.com/chart?chs=200x200&amp;chld=L%7C0&amp;cht=qr&amp;chl={{$key->address}}" alt class="participate-qr">
                                        <div class="participate-data">
                                            <p class="participate-title">{{$key->title}}</p>
                                            <div class="participate-address">
                                                <p>{{(strlen($key->address) > 35) ? substr($key->address, 0, 32) . '...' : $key->address}}</p>
                                                <svg class="address-done" width="14" height="11" viewbox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.36089 10.7881C5.22721 10.9241 5.04493 11 4.8555 11C4.66607 11 4.48379 10.9241 4.35011 10.7881L0.314169 6.70344C-0.104723 6.27957 -0.104723 5.5924 0.314169 5.16926L0.819556 4.65787C1.23845 4.234 1.91682 4.234 2.33572 4.65787L4.8555 7.20759L11.6643 0.317902C12.0832 -0.105967 12.7623 -0.105967 13.1804 0.317902L13.6858 0.829295C14.1047 1.25316 14.1047 1.94033 13.6858 2.36347L5.36089 10.7881Z" fill="#2D2D2D"/>
                                                </svg>
                                            </div>
                                            <div class="participate-footer">
                                                <div class="participate-status">
                                                    <a href="{{route('key.delete', $key->id)}}" type="button" class="btn btn-danger" style="background-color:#dc3545; margin-right:10px">Delete</a>
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{$key->id}}" data-bs-whatever="@mdo" style="background-color:#198754">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="editModal{{$key->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">{{$key->title}}</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{route('key.update')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$key->id}}">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Title:</label>
                                                        <input type="text" name="title" value="{{$key->title}}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Address:</label>
                                                        <input type="text" name="address" value="{{$key->address}}" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" style="background-color: #6c757d" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" style="background-color: #0d6efd">Edit</button>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                @endforeach
                            @else
                                <p>Пусто...</p>
                            @endif
                        </div>
                    </div>
                    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Creating</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{route('key.store')}}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Title:</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Address:</label>
                                        <input type="text" name="address" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" style="background-color: #6c757d" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" style="background-color: #0d6efd">Create</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                </section>
                <section class="participate" id="participate" style="margin: 25px 0">
                    <h4 class="section-title">You can <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#editModalImage" data-bs-whatever="@mdo">Update</button> <span>images</span> here!</h4>
                    <div class="modal fade" id="editModalImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit image</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{route('image.update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Edit image:</label>
                                        <select name="id" class="form-select" aria-label="Default select example" required>
                                            <option value="" selected>Select...</option>
                                            <option value="1">Creator</option>
                                            <option value="2">Logo_white</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">New image:</label>
                                        <input type="file" name="image" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" style="background-color: #6c757d" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" style="background-color: #0d6efd">Edit</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                </section>
                <section class="participate" id="participate" style="margin: 25px 0">
                    <h4 class="section-title">You can <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#editModalText" data-bs-whatever="@mdo">Update</button> <span>texts</span> here!</h4>
                    <div class="modal fade" id="editModalText" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit text</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{route('text.update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Edit text:</label>
                                        <select name="id" class="form-select" aria-label="Default select example" required>
                                            <option value="" selected>Select...</option>
                                            @foreach ($texts as $text)
                                                <option value="{{$text->id}}">{{(strlen($text->text) > 55) ? substr($text->text, 0, 52) . '...' : $text->text}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">New text:</label>
                                        <textarea name="text" class="form-control" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" style="background-color: #6c757d" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" style="background-color: #0d6efd">Edit</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                </section>
                <section class="participate" id="participate" style="margin: 25px 0">
                    <h4 class="section-title">You can <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#editModalColor" data-bs-whatever="@mdo">Update</button> <span>color</span> here!</h4>
                    <div class="modal fade" id="editModalColor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit text</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{route('color.update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">New color:</label>
                                        <input type="text" name="color" value="{{$color['text']}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" style="background-color: #6c757d" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" style="background-color: #0d6efd">Edit</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
