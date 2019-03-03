// Dashboard 1 Morris-chart
	
Morris.Area({
    element: 'extra-area-chart',
    data: %data,
    xkey: 'period',
    ykeys: %major,
    labels: %major,
    pointSize: 3,
    fillOpacity: 0,
    pointStrokeColors:%color,
    behaveLikeLine: true,
    gridLineColor: '#e0e0e0',
    lineWidth: 1,
    hideHover: 'auto',
    lineColors: %color,
    resize: true
    
});