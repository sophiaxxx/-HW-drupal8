var http = require('http');
var req = require('request');
var hostname = '127.0.0.1';
var port = 7774;


http.createServer(function(request, response){
	req.post({
		url:'http://ycchen.im.ncnu.edu.tw/join.php', 
		form: {'安安': '你好', '先去洗澡': '晚安'}
	},function(err, res ,body)
	{
		response.writeHead(200, { 'Content-Type': 'text/html'});
		response.write(body);
		response.end();  
	});
}).listen(port, hostname);

/*
var request = require('request');
request('http://www.google.com', function (error, response, body) {
  console.log('error:', error); // Print the error if one occurred
  console.log('statusCode:', response && response.statusCode); // Print the response status code if a response was received
  console.log('body:', body); // Print the HTML for the Google homepage.
});
request.post({url:'http://ycchen.im.ncnu.edu.tw/join.php', 
	form: {key:'value'}}, function(err,httpResponse,body)
{
res.writeHead(200);
	res.write('hello!');
	res.end();  
});
*/


