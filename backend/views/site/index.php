

 <!-- Main content -->
    <section class="content">
    <div class="panel panel-default">
      <div class="row ">
          <div class="col-md-6" style="padding-right: 0px;">
            <div class="col-md-6" style="border-right: 1px solid #ddd;">
                <div class="panel-body text-center" style="border-bottom: 1px solid #ddd;">
                  今日
                </div>
                <div class="panel-body">
                    <table class="table">
                      <tr>
                        <td align="right">订单数</td>
                        <td>0</td>
                        <td align="right">总金额数</td>
                        <td>0</td>
                      </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6" style="border-right: 1px solid #ddd;">
                 <div class="panel-body text-center" style="border-bottom: 1px solid #ddd;">
                  昨日
                 </div>
                 <div class="panel-body">
                    <table class="table">
                      <tr>
                        <td align="right">订单数</td>
                        <td>0</td>
                        <td align="right">总金额数</td>
                        <td>0</td>
                      </tr>
                    </table>
                 </div>
            </div>
          </div>
          <div class="col-md-6" style="padding-left: 0px;">
            <div class="col-md-6" style="border-right: 1px solid #ddd;">
                <div class="panel-body text-center" style="border-bottom: 1px solid #ddd;">
                  本月
                </div>
                <div class="panel-body">
                    <table class="table">
                      <tr>
                        <td align="right">订单数</td>
                        <td>0</td>
                        <td align="right">总金额数</td>
                        <td>0</td>
                      </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel-body text-center" style="border-bottom: 1px solid #ddd;">
                  上月
                </div>
                <div class="panel-body">
                    <table class="table">
                      <tr>
                        <td>订单数</td>
                        <td>0</td>
                        <td>总金额数</td>
                        <td>0</td>
                      </tr>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">

          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">曲线图</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">柱状图</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                  <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
          </div>

        </div>

        <div class="col-md-6">
          <div data-autoheight="130">
              <div id="allmap"  style="width:100%;height:600px"></div>
          </div>
        </div>

      </div>
    </section>
    <!-- /.content -->

    <?php $this->beginBlock('footer');  ?>
      <!-- <body></body>后代码块 -->
      <?php include '/js/index.php';?>
    <?php $this->endBlock(); ?>
    