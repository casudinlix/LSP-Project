@extends('layouts.app')
@section('title', 'Dashboard')
@section('parentPageTitle', 'App')
@section('css')

@endsection
@section('content')

@endsection
@section('js')

@endsection
@section('modal')

@endsection
@section('script')

@endsection

nim = tahunangkatab-kdjurusan-totalsiswa tshun angkata sama
nim = kdjurusan-tahunangkatab-totalsiswa tshun angkata sama

json_encode = simpan ke bentuk json_decode
json_decode($json,true)= convert to array
--Session
set session $token=session(['token' => $id]);
delete Session
  {{dd(session()->forget('token'))}}
  menampilakn Session
  session('nama session')
DB::beginTransaction();

    try {
        DB::commit();
        // all good
        toastr()->success('Sukses', 'Sukses!');
        return redirect()->back();
    } catch (\Exception $e) {
        DB::rollback();
        toastr()->error($e->getMessage());
        return redirect()->back();
    }

--Session
set session $token=session(['token' => $id]);
delete Session
  {{dd(session()->forget('token'))}}
  menampilakn Session
  session('nama session')
-------------
-------tiap bikin guard baru
Clear the config cache php artisan config:clear or rebuild it php artisan config:cache.
-------
  $user = \App\User::find(1);
    $user->notify(new \Modules\Dtd\Notifications\Invite);
data-toggle="tooltip" data-placement="top" title="Tooltip on top"

$("#myModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-content").load(link.attr("href"));
});
---modal conten
<div class="modal" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Terms &amp; Conditions</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                    <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                    <i class="fa fa-check"></i> Perfect
                </button>
            </div>
        </div>
    </div>
</div>

---modal conten ajax

    <div class="block block-themed block-transparent mb-0">
        <div class="block-header bg-primary-dark">
            <h3 class="block-title">Terms &amp; Conditions</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                    <i class="si si-close"></i>
                </button>
            </div>
        </div>
        <div class="block-content">
            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-alt-success" data-dismiss="modal">
            <i class="fa fa-check"></i> Perfect
        </button>
    </div>



$("#myModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-content").load(link.attr("href"));
});

jika select2 disabled serach, remove (remove tabindex="-1" from modal)

DB::table('users')
    ->updateOrInsert(
        ['email' => 'john@example.com', 'name' => 'John'],
        ['votes' => '2']
    );

    -------
    $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:roles,name'
        ]);
onkeyup="this.value = this.value.toUpperCase();"
order: [[ 10, "desc" ]]
$req->validate([
    'name' => 'required|string|max:100',
    'email' => 'required|email|unique:users',
    'password'=>'required|min:6'

]);
