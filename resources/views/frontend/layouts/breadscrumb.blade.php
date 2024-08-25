<section class="breadscrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2>{{$breadcrumb_title}}</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{URL::to('/')}}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{$breadcrumb_title}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>