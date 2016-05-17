<!-- Page Content -->        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Data Analysis</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-list"></i> Choose a task
                          
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
													<th>AIRCRAFT</th>
                                                    <th>DATE</th>
                                                    <th>START TIME</th>
                                                    <th>END TIME</th>
                                                    <th>EVENT</th>
													<th>DETAIL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											// Use PHP to throw the table
											$con = mysqli_connect("119.29.106.147","esdc","123456","ESDC");
											if (!$con)
											{
												die('Could not connect: ' . mysql_error());
											}
											// some code
											$result = mysqli_query($con,"select * from task order by t_id desc limit 0,7;");

											while($row = mysqli_fetch_array($result))
											  {
												$html_code = "
												<tr>
                                                    <td>".$row['t_id']."</td>
													<td>".$row['a_id']."</td>
                                                    <td>".$row['t_date']."</td>
                                                    <td>".$row['t_start_time']."</td>
                                                    <td>".$row['t_end_time']."</td>
                                                    <td>".$row['description']."</td>
													<td><a href=\"./analyze2?id=".$row['t_id']."\">Detail</a></td>
												</tr>
												
												";
												echo $html_code;
											  }
											?>
                                            </tbody>
                                        </table>
                                        <div class="row">
            	<div class="col-lg-3"></div>
            	<div class="col-lg-1">
            		<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal"> Graph </button>
            	</div>
            	<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  					<div class="modal-dialog" role="document">
    					<div class="modal-content">
      						<div class="modal-header">
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        						<h4 class="modal-title" id="myModalLabel">table title</h4>
      						</div>
      						<div class="modal-body">
       					 	...
      						</div>
      						<div class="modal-footer">
        						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						<button type="button" class="btn btn-primary">Save changes</button>
      						</div>
    					</div>
  					</div>
				</div>
            	<div class="col-lg-4"></div>
            	<div class="col-lg-1">
            		<button type="button" class="btn btn-primary btn-sm" > Export </button>
            	</div>
            	<div class="col-lg-3"></div>
            </div>
            							<!-- /.row -->
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                
            </div>
            <!-- /.row -->
            
            <!-- 
			<div class="row">
            	<div class="col-lg-12">
            		<div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>AIRCRAFT</th>
                                                    <th>DATE</th>
                                                    <th>TIME</th>
                                                    <th>POLL1</th>
                                                    <th>POLL2</th>
                                                    <th>POLL3</th>
                                                    <th>POLL4</th>
                                                    <th>POLL5</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											// Use PHP to throw the table

											$result = mysqli_query($con,"select * from raw_data order by d_id desc limit 0,5;");

											while($row = mysqli_fetch_array($result))
											  {
												$html_code = "
												<tr>
                                                    <td>".$row['a_id']."</td>
													<td>".$row['date']."</td>
                                                    <td>".$row['time']."</td>
                                                    <td>".$row['poll_1']."</td>
                                                    <td>".$row['poll_2']."</td>
                                                    <td>".$row['poll_3']."</td>
													<td>".$row['poll_4']."</td>
													<td>".$row['poll_5']."</td>

												</tr>
												
												";
												echo $html_code;
											  }
											?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!~~ /.table-responsive ~~>
            	</div>
            	<!~~ /.col-lg-12~~>
            </div>
            <!-- /.row -->
 -->
            <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                            <div class="panel-heading">
                                Map
                            </div>
                            <div class="panel-body">
                                <div id="container" style="height:250px;width:100%;">
                                </div>
                           
                            
                                <div id="r-result">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-4">
									<input type="button" class="btn btn-default btn-sm" onclick="openHeatmap();" value="Show Pollution Map"/>								
								</div>
								<div class="col-lg-4">
									<input type="button" class="btn btn-default btn-sm" onclick="closeHeatmap();" value="Hide Pollution Map"/>
                                </div>
                                <div class="col-lg-2"></div>
                                </div>
                             </div>
                               
                 <!-- /#wrapper -->
    <!-- MapHotareaJS -->
	<script type="text/javascript">
    var map = new BMap.Map("container");          // 创建地图实例

    var point = new BMap.Point(116.418261, 39.921984);
    map.centerAndZoom(point, 15);             // 初始化地图，设置中心点坐标和地图级别
    map.enableScrollWheelZoom(); // 允许滚轮缩放
    

    var points =[
	<?php
	$result = mysqli_query($con,"SELECT * FROM `raw_data` limit 0,50;");

	while($row = mysqli_fetch_array($result))
	  {
		$html_code = "{\"lng\":".$row['longitude'].",\"lat\":".$row['latitude'].",\"count\":200},";
		echo $html_code;
	  }
	?>
];
   
    if(!isSupportCanvas()){
    	alert('热力图目前只支持有canvas支持的浏览器,您所使用的浏览器不能使用热力图功能~')
    }
	//详细的参数,可以查看heatmap.js的文档 https://github.com/pa7/heatmap.js/blob/master/README.md
	//参数说明如下:
	/* visible 热力图是否显示,默认为true
     * opacity 热力的透明度,1-100
     * radius 势力图的每个点的半径大小   
     * gradient  {JSON} 热力图的渐变区间 . gradient如下所示
     *	{
			.2:'rgb(0, 255, 255)',
			.5:'rgb(0, 110, 255)',
			.8:'rgb(100, 0, 255)'
		}
		其中 key 表示插值的位置, 0~1. 
		    value 为颜色值. 
     */
	heatmapOverlay = new BMapLib.HeatmapOverlay({"radius":20});
	map.addOverlay(heatmapOverlay);
	heatmapOverlay.setDataSet({data:points,max:100});
	//是否显示热力图
    function openHeatmap(){
        heatmapOverlay.show();
    }
	function closeHeatmap(){
        heatmapOverlay.hide();
    }
	closeHeatmap();
    function setGradient(){
     	/*格式如下所示:
		{
	  		0:'rgb(102, 255, 0)',
	 	 	.5:'rgb(255, 170, 0)',
		  	1:'rgb(255, 0, 0)'
		}*/
     	var gradient = {};
     	var colors = document.querySelectorAll("input[type='color']");
     	colors = [].slice.call(colors,0);
     	colors.forEach(function(ele){
			gradient[ele.getAttribute("data-key")] = ele.value; 
     	});
        heatmapOverlay.setOptions({"gradient":gradient});
    }
	//判断浏览区是否支持canvas
    function isSupportCanvas(){
        var elem = document.createElement('canvas');
        return !!(elem.getContext && elem.getContext('2d'));
    }
	</script>
    
    <!-- MapAPI -->

                 
                </div>
                
                </div>
                <!-- /.col-lg-12 -->
                </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    
    


</body>

</html>
