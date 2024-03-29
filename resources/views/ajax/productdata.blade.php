<div class="row mb-3 align-items-md-stretch">
    @foreach ($products as $row)
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card zoom-on" style="">
                <img class="card-img-top card-img-product" src="{{ asset('/image/sample-card.jpg') }}">
                <div class="card-body text-center">
                    <a class="text-decoration-none"
                        href="{{ URL::to('/phone/' . $row->parentPhone->phone_id . '/detail/' . $row->phone_details_id) . '/specs/0' }}">
                        <h6 class="card-title fw-bold truncate-text">
                            {{ $row->parentPhone->phone_name . ' ' . $row->parentSpecific->specific_name . ' ' . $row->parentColor->color_name ?? 'null' }}
                        </h6>
                    </a>
                    <h6 class="text-danger fw-bold">{{ number_format($row->price, 0, ',', '.') ?? 'null' }} VNĐ</h6>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-12 text-center">
        {!! $products->links() !!}
    </div>
</div>