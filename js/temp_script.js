// Set the dimensions of the canvas
var margin = {top: 20, right: 0, bottom: 70, left: 70},
    width = 800 - margin.left - margin.right,
    height = 470 - margin.top - margin.bottom;


// Set the ranges
var x = d3.scale.ordinal().rangeRoundBands([0, width, 4], .05);
var y = d3.scale.linear().range([height, 0]);

// Define the axis
var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom")
    
var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left")
    .ticks(10);

//Create the Mouse hover tooltip (Make it invisible)
var div = d3.select("body").append("div")
     .attr("class", "tooltip")
     .style("opacity", 0);

//Create the SVG element
var temp_graph = d3.select("#temp_chart").append("svg")
    //.attr("width", width + margin.left + margin.right)
    //.attr("height", height + margin.top + margin.bottom)
    .attr("preserveAspectRatio", "xMinYMin meet")
    .attr("viewBox", "0 0 800 470")
    .append("g")
    .attr("transform", 
          "translate(" + margin.left + "," + margin.top + ")");
  

// Load the data in json format
d3.json("temp2json.php", function(error, data) 
{
  data.forEach(function(d) 
    {
      d.timestamp = d.timestamp;
      d.temperature = +d.temperature;
    });
  
  data = data.reverse();  //Reverse the data so older data appear on the left and new data on right
  
  
  // Scale the range of the data
  x.domain(data.map(function(d) { return d.timestamp; }));
  y.domain([0, 50]);


      
  // Add x axis
  temp_graph.append("g")
      .attr("class", "x_axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis)
 
  //Add x axis label
  temp_graph.append("text")
  	  .attr("class", "x_axis_label")
      .attr("transform", "translate(0," + height + ")")
      .attr("x", width/2)
      .attr("y", 30)
      .style("text-anchor", "middle")
      .text("Measurements over the last 24 Hours");    
      	
  //Add the y axis
  temp_graph.append("g")
      .attr("class", "y_axis")
      .call(yAxis)
      .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 7)
      .attr("dy", "-4em")
      .style("text-anchor", "end")
      .text("Temperature (℃)");
    
  

  // Create the bar graph
  temp_graph.selectAll("bar")
      .data(data)
      .enter()
      .append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.timestamp); })
      .attr("width", x.rangeBand())
      .attr("height", function(d) { return height - y(0); }) //Start from zero so the transition can happen
      .attr("y", function(d) { return y(0);})
      
      //Create the mouseover event
      .on('mouseover', function (d, i) 
        {
          div.transition()
              .duration("200")
              .style("opacity", 1);
          div.html("("+d3.format(".1f")(d.temperature)+"	°C)   @" + d.timestamp)
     			    .style("left", (d3.event.pageX + 10) + "px")
     			    .style("top", (d3.event.pageY - 15) + "px");
        })

       //Create the mouseout event
  	   .on('mouseout', function (d, i) 
        {
          	div.transition()
               .duration('200')
               .style("opacity", 0);
        })    

  //Create the animation
  temp_graph.selectAll("rect")
      .transition()
      .duration(4000)
      .attr("y", function(d) { return y(d.temperature); })
      .attr("height", function(d) { return height - y(d.temperature); })
      .delay(function(d,i){console.log(i) ; return(i*10)})
	  
});


 