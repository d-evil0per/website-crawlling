<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>web site crawling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
</head>

<body class="text-monospace " style="background-color: rgb(217,217,217);">
    <!-- Start: 2 Rows 1+2 Columns -->
    <div style="margin-top: 10px;">
        <div class="container">
            <div class="jumbotron jumbotron-fluid text-monospace text-capitalize text-center text-black-50 bg-white border rounded shadow" style="background-repeat: space;background-size: auto;filter: blur(0px) saturate(94%);opacity: 1;background-color: rgb(122,110,110);background-position: bottom;">
                <div class="row">
                    <div class="col-12 col-sm-3 col-md-2 col-lg-2 col-xl-2 offset-xl-1 bounce animated" style="background-size: contain;background-repeat: no-repeat;"><img src="<?=base_url()?>/assets/img/Project%20-%20Drawing%2015517359921816421243.png?h=d90800d01c0843dd5fa43710b24d0536" style="width: 100px;"></div>
                    <div class="col-11 col-sm-8 col-md-9 col-lg-9 col-xl-6 offset-1 offset-sm-0 offset-xl-0 jello animated">
                        <h1 class="display-4 text-monospace text-capitalize text-center text-black-50" style="font-size: 36px;"><strong>Web Crawler</strong></h1>
                        <p class="text-center">it crawls to Run!</p>
                        <form class="text-center">
                            <div class="form-row">
                                <div class="col-10 col-md-10 col-xl-6 offset-1 offset-md-1 offset-xl-3">
                                    <input type="hidden" id="baseurl" value="<?=base_url()?>">
                                    <input onkeyup="crawl(this)"  class="bg-white border rounded border-dark shadow-lg form-control form-control-sm" type="text" name="search" required="" placeholder="Enter Url Followed by space" autofocus="" autocomplete="off" inputmode="url"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row" id="process_quote" style="display: none">
                    <div class="col">
                        <blockquote class="blockquote">
                            <p class="mb-0" style="font-size: 12px;color: rgba(115,6,6,0.5);">If You Can Run, Respect Those Who Still Crawls</p>
                            <footer class="blockquote-footer" style="font-size: 14px;color: rgb(204,18,18);">D-eviloper</footer>
                        </blockquote>
                    </div>
                </div>
                <div class="row">
                    <div id="processstr" class="col-sm-8 col-md-9 col-lg-12 col-xl-9 offset-sm-3 offset-md-2 offset-lg-1 offset-xl-2" style="display: none;">
                        <div class="progress bg-white border rounded shadow" style="margin: 30px;width: 80%;">
                            <div class="progress-bar bg-dark progress-bar-striped progress-bar-animated" id="pbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"><span class="sr-only" id="process">0</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End: 2 Rows 1+2 Columns -->
    <section id="tab" style="display: none">
    <!-- Start: 1 Row 1 Column -->
    <div style="margin-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Preview</h5>
                        </div>
                        <div class="card-body">
                            <div style="height: 400px;overflow: auto">
                                <object data="#" id="preview" style="width:100%" height="400">
                              <p> <a href="" id="previewtxt">
                                Fallback link for browsers that don't support iframes
                              </a> </p>
                            </object>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Source</h5>
                        </div>
                        <div class="card-body">
                            <pre id="source" style="height: 400px;overflow: auto">
                                
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End: 1 Row 1 Column -->
    <!-- Start: 1 Row 1 Column -->
    <div style="margin-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Meta Data</h5>
                        </div>
                        <div class="card-body">
                            <div id="output"  style="height: 400px;overflow: auto"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Links &amp; Images</h5>
                        </div>
                        <div class="card-body">
                            <div id="output1"  style="height: 400px;overflow: auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End: 1 Row 1 Column -->
    </section>
    <footer style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-10 col-lg-4 col-xl-4 offset-md-1 offset-lg-4 offset-xl-4" style="background-color: rgba(255,255,255,0.39);color: rgb(127,127,127);">
                <div class="text-monospace text-capitalize d-xl-flex justify-content-xl-center"><strong class="text-monospace text-center text-muted">Made By&nbsp;<a class="text-danger" href="https://www.d-eviloper.co.in" target="_blank">D-eviloper</a></strong></div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>assets/js/crawl.js" ></script>
</body>

</html>