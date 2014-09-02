/**
 * Created by RayZheng on 8/28/14.
 */
/* after making any changes here enter "make" in your terminal to appy the changes */

/*var ffmapConfig = {
    // initial gravity, friction, of the graph at pageload:
    gravity:   0.05,
    friction:  0.73,
    theta:     0.8,
    charge:    1.0,
    distance:  1.0,
    strength:  1.0
};
function load_nodes(filename, data, fn) {
    d3.json(filename, function(json) {
        if (data) {
            // update existing nodes with new info
            // XXX inefficient data structure
            json.nodes.forEach(function(d, i) {
                var n
                data.nodes.forEach(function(x) {if (x.id == d.id) n = x})
                if (n) {
                    for (var key in d)
                        if (d.hasOwnProperty(key))
                            n[key] = d[key]

                    json.nodes[i] = n
                }
            })

            json.links.forEach(function(d, i) {
                var n
                data.links.forEach(function(x) {if (x.id == d.id) n = x})
                if (n) {
                    for (var key in d)
                        if (d.hasOwnProperty(key))
                            n[key] = d[key]

                    json.links[i] = n
                }
            })
        }

        // replace indices with real objects
        json.links.forEach( function(d) {
            if (typeof d.source == "number") d.source = json.nodes[d.source];
            if (typeof d.target == "number") d.target = json.nodes[d.target];
        })

        // count vpn links
        json.nodes.forEach(function(d) {
            d.vpns = []
            d.wifilinks = []
            d.clients = []
        })

        json.links.forEach(function(d) {
            var node, other

            if (d.type == "vpn") {
                d.source.vpns.push(d.target)
                d.target.vpns.push(d.source)
            } else if (d.type == "client") {
                d.source.clients.push(d.target)
                d.target.clients.push(d.source)
            } else {
                d.source.wifilinks.push(d.target)
                d.target.wifilinks.push(d.source)
            }
        })

        fn(json)
    })
}*/
var linkcolor = {'default':
    d3.scale.linear()
        .domain([1, 1.25, 1.5])
        .range(["#0a3", "orange", "red"]),
    'wifi':
        d3.scale.linear()
            .domain([1, 3, 10])
            .range(["#0a3", "orange", "red"])
};
function pacman() {
    var angle = d3.scale.linear()
        .domain([0, 1, 2, 3])
        .range([0.01, Math.PI/4, 0.01, Math.PI/4]);

    d3.timer(pacman_animate);
    var a = 0;

    var p = {x: 0, y: 0};
    var pm = vis.append("path")
        .style("fill", "#ff0")
        .style("stroke", "#000")
        .style("stroke-width", 2.5)
        .style("stroke-linejoin", "round");

    function pacman_animate() {
        var size = force.size();
        var nodes = force.nodes();
        var n = nodes.length;
        if (n == 0)
            return;

        a = (a + 0.10)%2;

        pm.attr("d", d3.svg.arc().innerRadius(0)
            .outerRadius(24).endAngle(-angle(a) + Math.PI/2 + 2*Math.PI).startAngle(angle(a) + Math.PI/2));

        var closest = null;
        var dd = Infinity;
        for (i = 0; i < n; i++) {
            var o = nodes[i];

            var d = Math.pow((o.x - p.x),2) + Math.pow( o.y - p.y, 2);
            if (d < dd) {
                dd = d;
                closest = o;
            }
        }

        var dx = closest.x - p.x;
        var dy = closest.y - p.y;

        var d = Math.sqrt(Math.pow(dx,2) +  Math.pow(dy,2));

        dx = dx/d;
        dy = dy/d;

        if (d>8) {
            p.x += dx * 2;
            p.y += dy * 6;
        } else {
            /*var snd;
            if (closest.flags.client) {
                snd = new Audio("lib/pacman_eatfruit.wav")
            } else {
                snd = new Audio("lib/pacman_eatghost.wav")
            }
            snd.play()*/

            data.nodes = data.nodes.filter(function (d) {
                return d.id != closest.id
            });

            data.links = data.links.filter(function (d) {
                return d.target.id != closest.id && d.source.id != closest.id
            });
            update();
        }

        pm.attr("transform", "matrix(" + [dx, dy, -dy, dx, p.x, p.y].join(",") + ")");
    }
}
var style;

/*window.onresize = resize;

function resize() {
    var chart = document.getElementById("chart");

    var w = chart.offsetWidth;
    var h = chart.offsetHeight;

    if (force)
        force.size([w, h]).start();
}*/
/*

var cp = d3.select("header").append("div")
    .attr("id", "controlpanel");

cp.append("button")
    .attr("class", "btn")
    .attr("value", "reload")
    .text("Aktualisieren")
    .on("click", reload);

cp.append("button")
    .attr("class", "btn")
    .attr("value", "reload")
    .on("click", pacman)
    .append("svg")
    .attr("width", 12)
    .attr("height", 12)
    .append("path")
    .attr("d", d3.svg.arc().innerRadius(0)
        .outerRadius(5)
        .endAngle(-Math.PI/4 + Math.PI/2 + 2*Math.PI)
        .startAngle(Math.PI/4 + Math.PI/2))
    .attr("fill", "#888")
    .attr("transform", "translate(6,7)");


var btns = cp.append("div")
    .attr("class", "btn-group")

btns.append("button")
    .attr("class", "btn active left")
    .attr("value", "clients")
    .text("Clients")
    .on("click", update_graph)

btns.append("button")
    .attr("class", "btn middle")
    .attr("value", "vpn")
    .text("VPN")
    .on("click", update_graph)

btns.append("button")
    .attr("class", "btn active right")
    .attr("value", "labels")
    .text("Labels")
    .on("click", update_graph)

cp.append("input")
    .on("keyup", function(){show_node(this.value)})
    .on("change", function(){show_node(this.value)})
    .attr("value", window.location.hash.substring(1))

var updated_at = cp.append("p")

var meshinfo = d3.select("#sidebar .content")
    .insert("div", ":first-child")

meshinfo.append("h2").text("Mesh")

meshinfo.append("p")
    .attr("id", "nodecount")

meshinfo.append("p")
    .attr("id", "gatewaycount")

meshinfo.append("p")
    .attr("id", "clientcount")

meshinfo.append("h3").text("Gravity")
    .append("span").attr("id", "gravity")
meshinfo.append("input").attr("type", "range").attr("min", "0").attr("max", "0.1").attr("step", "0.001")
    .attr("value",ffmapConfig.gravity)
    .on("change", function(d) {
        d3.select("span#gravity").text(this.value)
        force.gravity(this.value)
        force.start()
    })

meshinfo.append("h3").text("Distance")
    .append("span").attr("id", "distance")
meshinfo.append("input").attr("type", "range").attr("min", "0").attr("max", "2.0").attr("step", "0.01")
    .attr("value",ffmapConfig.distance)
    .on("change", function(d) {
        d3.select("span#distance").text(this.value)
        distScale = this.value
        force.start()
    })
*/

function show_node(query) {
    window.location.hash = '#' + query

    if (query.length == 0) {
        vis.selectAll(".node").classed("marked", false)
        return
    }

    var qlc = query.toLowerCase()

    vis.selectAll(".node")
        .classed("marked", function(d) {
            return d.macs.toLowerCase().indexOf(qlc) >= 0 ||
                d.name.toLowerCase().indexOf(qlc) >= 0
        })

    vis.selectAll(".node").each(function(d) { if (d.name.toLowerCase() == qlc || d.id.toLowerCase() == qlc) goto_node(d) })
}

function isConnected(a, b) {
    return linkedByIndex[a.index + "," + b.index] ||
        linkedByIndex[b.index + "," + a.index] ||
        a.index == b.index
}

function highlight(b) {
    return function(d) {
        if (dragging) return

        vis.selectAll(".node")
            .classed("highlight", function(o) {
                return isConnected(d, o) && b && !o.flags.client
            })

        vis.selectAll(".label")
            .classed("highlight", function(o) {
                return o == d && b
            })
    }
}

function goto_node(d) {
    if (d3.event.defaultPrevented)
        return

    show_node_info(d)
}

function show_node_info(d) {
    d3.selectAll("#nodeinfo").remove()

    nodeinfo = d3.select(".main-right-content")
        .append("div")
        .attr("id", "nodeinfo")

    nodeinfo.append("button")
        .attr("class", "close")
        .text("x")
        .on("click", function() {
            nodeinfo.remove()
        })

    nodeinfo.append("button")
        .attr("class", "refresh")
        .text("refresh")
        .on("click", function() {
            goto_node(d)
        })

    nodeinfo.append("h1")
        .text(d.name + " / " + d.id)

    nodeinfo.append("p")
        .append("label")
        .text("macs: " + d.macs)

    if (! d.flags.client) {
        imglink = "nodeplot.cgi?" + d.id.replace(/:/g,'')
        nodeinfo
            .append("h2")
            .text("Stats")
        nodeinfo
            .append("a")
            .attr("target","_blank")
            .attr("href",imglink)
            .append("img")
            .attr("style","width: 450px; height: 200px;")
            .attr("src",imglink)
    }

    nodeinfo.append("p")
        .append("label")
        .text("Clients: " + d.clients.length)

    nodeinfo.append("p")
        .append("label")
        .text("WLAN-Verbindungen: " + d.wifilinks.length)

    nodeinfo.append("h2").text("VPN-Links")

    nodeinfo.append("ul")
        .selectAll("li")
        .data(d.vpns)
        .enter().append("li")
        .append("a")
        .on("click", goto_node)
        .attr("href", "#")
        .text(function(d) {
            return d.name || d.macs
        })

    if (d.geo) {
        nodeinfo.append("h2").text("Geodaten")

        nodeinfo.append("p")
            .append("a")
            // Open the geomap in another window as we'd lose state of this
            // graph when the user navigates back.
            .attr("target","_blank")
            .attr("href","geomap.html?lat="+d.geo[0]+"&lon="+d.geo[1])
            .text(d.geo)
    }
}

function toggle_button(button) {
    button.classed("active", !button.classed("active"))
}

function update_graph() {
    var button = d3.select(this)
    var value = button.attr("value")
    toggle_button(button)

    visible[value] = button.classed("active")
    update()
}

var vis = d3.select(".main-right-content").append("svg")
    .attr("pointer-events", "all")
    .call(d3.behavior.zoom().on("zoom", redraw))
    .append("g")

vis.append("g").attr("class", "links")

vis.append("g").attr("class", "nodes")

vis.append("g").attr("class", "labels")
    .attr("pointer-events", "none")

var linkedByIndex

var chargeScale = ffmapConfig.charge,
    distScale = ffmapConfig.distance,
    strengthScale = ffmapConfig.strength

var force = d3.layout.force()
    .charge( function (d) {
        //if (d.flags.client)
            //return -30 * chargeScale

        return -100 * chargeScale
    })
    .gravity(ffmapConfig.gravity)
    .friction(ffmapConfig.friction)
    .theta(ffmapConfig.theta)
    .linkDistance(function (d) {
        switch (d.type) {
            case "client": return 20 * distScale
            default: return 70 * distScale
        }
    })
    .linkStrength(function (d) {
        switch (d.type) {
            case "vpn": return 0.01 * strengthScale
            case "client": return 1 * strengthScale
            default: return 0.2 * strengthScale
        }
    })
//resize()

function tick_event(e) {
    vis.selectAll(".link").selectAll("line")
        .attr("x1", function(d) { return d.source.x })
        .attr("y1", function(d) { return d.source.y })
        .attr("x2", function(d) { return d.target.x })
        .attr("y2", function(d) { return d.target.y })

    vis.selectAll(".node")
        .attr("cx", function(d) { return d.x })
        .attr("cy", function(d) { return d.y })

    vis.selectAll(".label").attr("transform", function(d) {
        return "translate(" + d.x + "," + d.y + ")";
    })
}

var data;

var visible = {clients: false, vpn: false, labels: false};

function reload() {
    //load_nodes(ffmapConfig.nodes_json, data, handler);
    handler(ffmapConfig.nodes_json);
    function handler(json) {
        data = json;

        date = new Date();


        //updated_at.text(date.toString('HH:mm:ss'));

        var nNodes = data.nodes;/*.filter(function(d) {
                return !d.flags.client && d.flags.online
            }).length,
            nLegacyNodes = data.nodes.filter(function (d) {
                return !d.flags.client && d.flags.online && d.flags.legacy
            }).length,
            nGateways = data.nodes.filter(function(d) {
                return d.flags.gateway && d.flags.online
            }).length,
            nClients = data.nodes.filter(function(d) {
                return d.flags.client && d.flags.online
            }).length;*/

        d3.select("#nodecount")
            .text(nNodes + " Knoten");

        /*d3.select("#gatewaycount")
            .text(nGateways + " Gateways");

        d3.select("#clientcount")
            .text("ungefähr " + (nClients - nLegacyNodes) + " Clients");*/

        //data = wilder(data);

        update();
    }
}

function fixate_geonodes(nodes, x) {
    nodes.filter(function(d) {
        return d.geo !== null;
    }).forEach(function(d) {
        d.fixed = x;
    })
}

function wilder(data) {
    var nodes = data.nodes.filter(function(d) {
        return d.geo !== null;
    })

    var lat = nodes.map(function(d) { return d.geo[0] });
    var lon = nodes.map(function(d) { return d.geo[1] });

    var max_lat = Math.min.apply(null, lat);
    var min_lat = Math.max.apply(null, lat);

    var min_lon = Math.min.apply(null, lon);
    var max_lon = Math.max.apply(null, lon);

    var width = force.size()[0];
    var height = force.size()[1];

    var scale_x = width / (max_lon - min_lon);
    var scale_y = height / (max_lat - min_lat);

    nodes.forEach(function(d) {
        if (d.x || d.y)
            return;

        d.x = (d.geo[1] - min_lon) * scale_x;
        d.y = (d.geo[0] - min_lat) * scale_y;
    })

    return data;
}

var dragging = false;

var node_drag = d3.behavior.drag()
    .on("dragstart", dragstart)
    .on("drag", dragmove)
    .on("dragend", dragend);

var d3_layout_forceDragNode;

function dragstart(d) {
    d3.event.sourceEvent.stopPropagation();
    dragging = true;
    d3_layout_forceDragNode = d;
    d.fixed |= 2;
}

function dragmove() {
    d3_layout_forceDragNode.px = d3.event.x;
    d3_layout_forceDragNode.py = d3.event.y;
    force.resume(); // restart annealing
}

function dragend() {
    d3.event.sourceEvent.stopPropagation();
    d3_layout_forceDragNode.fixed &= 1;
    d3_layout_forceDragNode = null;
    dragging = false;
}

function update() {
    var links = data.links
        /*.filter(function (d) {
            if (!visible.vpn && d.type == "vpn")
                return false;

            if (!visible.clients && (d.source.flags.client || d.target.flags.client))
                return false;

            // hides links to clients
            if (!visible.vpn && (d.source.flags.vpn || d.target.flags.vpn))
                return false;

            return true;
        })*/;

    var link = vis.select("g.links")
        .selectAll("g.link")
        .data(links, function(d) {
            return d.id;
        });

    var linkEnter = link.enter().append("g")
        .attr("class", function(d) {
            return "link " + d.type;
        })
        .on("mouseover", function(d) {
            if (dragging) return;

            d.source.fixed |= 2;
            d.target.fixed |= 2;
        })
        .on("mouseout", function(d) {
            if (dragging) return;

            d.source.fixed &= 1;
            d.target.fixed &= 1;
        })

    linkEnter.append("line")
        .append("title");

    link.selectAll("line")
        .filter( function (d) {
            return d.type != 'client';
        })
        .style("stroke", function(d) {
            switch (d.type) {
                case "vpn":
                    return linkcolor['default'](Math.max.apply(null, d.quality.split(",")));
                default:
                    var q;
                    try {
                        q = Math.max.apply(null, d.quality.split(","));
                    } catch(e) {
                        q = d.quality;
                    }
                    return linkcolor['wifi'](q);

            }
        })
        .attr("class", function(d) {
            try {
                return d.quality.split(",").length==1?"unidirectional":"bidirectional";
            } catch(e) {
                return "bidirectional";
            }
        })

    link.selectAll("title")
        .text( function (d) {
            var s = d.quality;
            if (d.type)
                s += " (" + d.type + ")";

            return s;
        })

    link.exit().remove();

    var nodes = data.nodes/*.filter(function (d) {
        if (!visible.vpn && d.flags.vpn)
            return false;

        if (!visible.clients && d.flags.client)
            return false;

        if (!d.flags.online)
            return false;

        return true;
    })
        .sort(function(a, b) {
            return (a.flags.client?1:0) < (b.flags.client?1:0)
        })*/;

    var node = vis.select("g.nodes")
        .selectAll(".node")
        .data(nodes,
        function(d) {
            return d.id;
        }
    );

    var nodeEnter = node.enter().append("circle")
        .attr("class", "node")
        .on("mouseover", highlight(true))
        .on("mouseout", highlight(false))
        .on("click", goto_node)
        .call(node_drag)
        .attr("r", function(d) {
            if (d.flags.client)
                return 4
            else
                return 8
        });

    node.attr("class", function(d) {
        var s = ["node"]
        if (d.firmware)
            s.push(["gluon"]);

        if (d.vpns.length > 0)
            s.push(["uplink"]);

        for (var key in d.flags)
            if (d.flags.hasOwnProperty(key) && d.flags[key]);
                s.push(key);

        return s.join(" ");
    })

    var label = vis.select("g.labels")
        .selectAll("g.label")
        .data(nodes.filter(function(d) {
        //return !d.flags.client && visible.labels;
        return visible.labels;
    }), function(d) {
            return d.id;
        }
    );

    var labelEnter = label.enter()
        .append("g")
        .attr("id", function (d) {
            return d.id
        })
        .attr("class", "label");

    var geodot = labelEnter.filter(function(d) { return d.geo });

    geodot.append("circle")
        .attr("class", "dot")
        .attr("r", 3);

    var geodot = labelEnter.filter(function(d) { return !d.geo });

    geodot.selectAll(".dot").remove();

    labelEnter.append("text")
        .attr("class", "name")
        .attr("text-anchor", "middle")
        .attr("y", "21px")
        .attr("x", "0px");

    label.selectAll("text.name")
        .text(function(d) {
            if (d.name != "")
                return d.name;

            return d.id;
        });

    labelTextWidth = function (e) {
        return e.parentNode.querySelector("text").getBBox().width + 3;
    }

    labelEnter.insert("rect", "text")
        .attr("y", "10px")
        .attr("x", function(d) { return labelTextWidth(this) / (-2)})
        .attr("width", function(d) { return labelTextWidth(this)})
        .attr("height", "15px");


    label.exit().remove();

    nodeEnter.append("title");

    node.selectAll("title")
        .text(function(d) { return d.name?d.name:" " });

    label.selectAll(".uplinks").remove();

    if (!visible.vpn) {
        var uplink_info = label.filter(function (d) {
            return d.vpns.length > 0;
        })
            .append("g")
            .attr("class", "uplinks");

        uplink_info.append("path")
            .attr("d","m -2.8850049,-13.182327"
                + "c 7.5369165,0.200772 12.1529864,-1.294922 12.3338513,-10.639456"
                + "l 2.2140476,1.018191 -3.3137621,-5.293097 -3.2945999,5.20893 2.4339957,-0.995747"
                + "c -0.4041883,5.76426 -1.1549641,10.561363 -10.3735326,10.701179 z");

        uplink_info.append("text")
            .attr("text-anchor", "middle")
            .attr("y", 3 - 20)
            .text(function (d) {return d.vpns.length});
    }

    node.exit().remove();

    force.nodes(nodes)
        .links(links)
        .alpha(0.1)
        .start();

    if (initial == 1) {
        fixate_geonodes(data.nodes, true);

/*        force.alpha(0.1)
        while(force.alpha() > 0.05);
            force.tick()

        fixate_geonodes(data.nodes, false);

        force.alpha(0.1);
        while(force.alpha() > 0.05)
            force.tick();*/

        force.on("tick", tick_event);
        force.start();

        if (window.location.hash.length > 1)
            show_node(window.location.hash.substring(1));
    }

    initial = 0;

    linkedByIndex = {};

    links.forEach(function(d) {
        linkedByIndex[d.source.index + "," + d.target.index] = 1
    });
}

var initial = 1;

reload();

var timer = window.setInterval(reload, 30000);

function redraw() {
    vis.attr("transform",
        "translate(" + d3.event.translate + ") "
            + "scale(" + d3.event.scale + ")");
}

/*document.querySelector("#sidebar .toggler").onclick = function() {
    var o = document.querySelector("#sidebar .content")
    o.style.display = o.style.display=="none"?"block":"none"
}*/

