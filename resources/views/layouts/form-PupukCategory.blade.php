<form action="{{ route('search.pupuk') }}" method="GET">
    <div class="category">
        <input type="hidden" name="pupuk" value="2">
        <button type="submit" class="btn btn-link categoty">Pupuk</button>
    </div>
</form>
<form action="{{ route('search.benih') }}" method="GET">
    <div class="category">
        <input type="hidden" name="benih" value="1">
        <button type="submit" class="btn btn-link categoty">Benih</button>
    </div>
</form>
<form action="{{ route('search.peralatan') }}" method="GET">
    <div class="category">
        <input type="hidden" name="peralatan" value="3">
        <button type="submit" class="btn btn-link categoty">Peralatan</button>
    </div>
</form>