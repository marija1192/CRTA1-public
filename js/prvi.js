function prviGraf () {
  


var margin = {top: 20, right: 200, bottom: 100, left: 50},
    margin2 = { top: 430, right: 10, bottom: 20, left: 40 },
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom,
    height2 = 500 - margin2.top - margin2.bottom;

var parseDate = d3.time.format("%d/%m/%Y").parse;
var bisectDate = d3.bisector(function(d) { return d.date; }).left;

var xScale = d3.time.scale()
    .range([0, width]);


var yScale = d3.scale.linear()
    .range([height, 0]);

yScale.domain([0,100]);

var color = d3.scale.ordinal().range(["#48A36D",   "#E2705C", "#E37756", "#E38457", "#EAD67C", "#F2DE8A"]);  


var xAxis = d3.svg.axis()
    .scale(xScale)
    .orient("bottom");


var yAxis = d3.svg.axis()
    .scale(yScale)
    .orient("left");  

var line = d3.svg.line()
    .interpolate("basis")
    .x(function(d) { return xScale(d.date); })
    .y(function(d) { return yScale(d.rating); })
    .defined(function(d) { return d.rating; });  // Hiding line value defaults of 0 for missing data

var maxY = 100; // Defined later to update yAxis

var svg = d3.select("#prviDijagram").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom) //height + margin.top + margin.bottom
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


// Create invisible rect for mouse tracking
svg.append("rect")
    .attr("width", width)
    .attr("height", height)                                    
    .attr("x", 0) 
    .attr("y", 0)
    .attr("id", "mouse-tracker")
    .style("fill", "white"); 




d3.json("public/data.json", function(error, data) { 
  color.domain( 
    ["sns",  "dss","ds"]
  /*d3.keys(data[0]).filter(function(key) { // Set the domain of the color ordinal scale to be all the csv headers except "date", matching a color to an issue
    return key !== "date"; 
  })*/);

  data.forEach(function(d) { // Make every date in the csv data a javascript date object format
    d.date = parseDate(d.vreme);
    d.name = d.poslanickiKlub;
  });

var categories = "";


function filterPodaci (name,data) {
      a = data.filter(function(po){return po.poslanickiKlub==name});

      a =  a.map(function(d) { 
       
          return {
            date: d.date, 
            rating: +(d.prihodi),
            };
      });

    return a;
}
  var categories = color.domain().map(function(name) { // Nest the data into an array of objects with new keys
     
     return{
      name: name,
      visible: (name === "sns" ? true : false),
      values: filterPodaci(name, data)
     } 
     
    
  });

  xScale.domain(d3.extent(data, function(d) { return d.date; })); // extent = highest and lowest points, domain is data, range is bouding box

  yScale.domain([0, 100
    //d3.max(categories, function(c) { return d3.max(c.values, function(v) { return v.rating; }); })
  ]);

  
 


  // draw line graph
  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("x", -10)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Imovina");

  var issue = svg.selectAll(".issue")
      .data(categories) // Select nested data and append to new svg group elements
    .enter().append("g")
      .attr("class", "issue");   

  issue.append("path")
      .attr("class", "line")
      //.style("pointer-events", "none") // Stop line interferring with cursor
      .attr("id", function(d) {
        return "line-" + d.name.replace(" ", "").replace("/", ""); // Give line id of line-(insert issue name, with any spaces replaced with no spaces)
      })
      .attr("d", function(d) { 
        return d.visible ? line(d.values) : null; // If array key "visible" = true then draw line, if not then don't 
      })
      //.attr("clip-path", "url(#clip)")//use clip path to make irrelevant part invisible
      .style("stroke", function(d) { return color(d.name); });






  // draw legend
  var legendSpace = 200 / categories.length; // 450/number of issues (ex. 40)    

  issue.append("rect") //legenda
      .attr("width", 10)
      .attr("height", 10)                                    
      .attr("x", width + (margin.right/3) - 15) 
      .attr("y", function (d, i) { return (legendSpace)+i*(legendSpace) - 8; })  // spacing
      .attr("fill",function(d) {
        return d.visible ? color(d.name) : "#F1F1F2"; // If array key "visible" = true then color rect, if not then make it grey 
      })
      .attr("class", "legend-box")

      .on("click", function(d){ // On click make d.visible 
        d.visible = !d.visible; // If array key for this data selection is "visible" = true then make it false, if false then make it true


        //treba mi uzimanje drugih vrednosti
          
        maxY = findMaxY(categories); // Find max Y rating value categories data with "visible"; true
        yScale.domain([0,maxY]); // Redefine yAxis domain based on highest y value of categories data with "visible"; true
        svg.select(".y.axis")
          .transition()
          .call(yAxis);   

        issue.select("path") //linija
          .transition()
          .attr("d", function(d){
            return d.visible ? line(d.values) : null; // If d.visible is true then draw line for this d selection
          })

        issue.select("rect") // legenda
          .transition()
          .attr("fill", function(d) {
                return d.visible ? color(d.name) : "#F1F1F2";
              });
            })

          .on("mouseover", function(d){  // lgenda

            d3.select(this)
              .transition()
              .attr("fill", function(d) { return color(d.name); });

            d3.select("#line-" + d.name.replace(" ", "").replace("/", ""))
              .transition()
              .style("stroke-width", 2.5);  
          })

          .on("mouseout", function(d){ //legneda

            d3.select(this)
              .transition()
              .attr("fill", function(d) {
              return d.visible ? color(d.name) : "#F1F1F2";});

            d3.select("#line-" + d.name.replace(" ", "").replace("/", ""))
              .transition()
              .style("stroke-width", 1.5);
          })
      
  issue.append("text") //legneda ime
      .attr("x", width + (margin.right/3)) 
      .attr("y", function (d, i) { return (legendSpace)+i*(legendSpace); })  // (return (11.25/2 =) 5.625) + i * (5.625) 
      .text(function(d) { return d.name; });  


var focus = svg.append("g")
              .attr("class", "focus")
              .style("display", "none");

          focus.append("circle")
              .attr("r", 4.5);

          focus.append("text")
              .attr("x", 9)
              .attr("dy", ".35em");

          svg.append("rect")
              .attr("class", "overlay")
              .attr("width", width)
              .attr("height", height)
              .on("mouseover", function() { focus.style("display", null); })
              .on("mouseout", function() { focus.style("display", "none"); })
              .on("mousemove", mousemove);

          function mousemove() {
            var x0 = /*xScale*/(d3.mouse(this)[0]) /** (-1)*/; //xScale.invert(d3.mouse(this)[0]),
            y0 = /*yScale*/(d3.mouse(this)[1]) ,
                i = bisectDate(data, x0, 1),
                d0 = data[i - 1],
                d1 = data[i],
                d = x0 - d0.date > d1.date - x0 ? d1 : d0;
            focus.attr("transform", "translate(" + /*xScale(d.date)*/x0 + "," + /*yScale(d.prihodi)*/y0 + ")");
            yScale.domain([0,maxY]);
            
            /*console.log(yScale.invert(y0));*/

            focus.select("text").text( parseInt( yScale.invert(y0) )  );
          }
}); // End Data callback function
  
  function findMaxY(data){  // Define function "findMaxY"
    var maxYValues = data.map(function(d) { 
      if (d.visible){
        return d3.max(d.values, function(value) { // Return max rating value
          return value.rating; })
      }
    });
    return d3.max(maxYValues);
    
  }

}