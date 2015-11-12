<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.docu_content
{
	max-width: 80%;
}
h1
{
	color: #333;
    font-size: 34px;
    font-weight: 300;
    letter-spacing: -.01em;
    line-height: 1.3;
    margin: 36px 0 24px;
}
h2
{
	color: #333;
    font-size: 26px;
    font-weight: 400;
    letter-spacing: -.01em;
    line-height: 1.3;
    margin: 26px 0 20px;
}
h3
{
	color: #333;
    font-size: 21px;
    font-weight: 400;
    line-height: 1.3;
    margin: 24px 0 14px 0;
}
.special 
{
    background-color: #e5ecf9;
	padding: 6px 8px 6px 10px;
    border-left: 6px solid #36c;
}
p 
{
    display: block;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
}
a, a:link, a:visited, a:active
{
	color: #4285f4;
    text-decoration: none;
}
// a:hover
// {
	// font-weight: bold;
// }
#gc-content ol.toc {
    list-style-type: none;
}
#gc-content ol.toc ul, #gc-content ol.toc ol {
    list-style-type: none;
}
@media screen, projection
p, pre, table, form {
    margin: 10px 0;
}
.docu_content {
    color: #222;
    font-family: Roboto, sans-serif;
    font-size: 14px;
    -webkit-font-smoothing: antialiased;
    font-weight: 400;
    line-height: 1.6;
}
pre
{
	padding: 6px 10px;
    background-color: #fafafa;
    border: 1px solid #ddd;
    overflow: auto;
	font: 14px 'Droid Sans Mono', monospace;
	color: #007000;
    -webkit-font-smoothing: auto;
}
code
{
	background: none;
	font: 14px 'Droid Sans Mono', monospace;
	color: #007000;
    -webkit-font-smoothing: auto;
}

.apiparam
{
	color: #066;
    font-style: italic;
    font-weight: bold;
}
dd {
    display: block;
    -webkit-margin-start: 40px;
}
.note, .caution, .dogfood, .warning {
    background-color: #efefef;
    padding: 6px 8px 6px 10px;
    border-left: 6px solid #999;
}
table
{
	width: 100%;
	border: 1px solid #ddd;
    border-spacing: 0;
    border-collapse: collapse;
    margin: 0 0 1.5em;
	font-size: 1em;
}
thead
{
	display: table-header-group;
    vertical-align: middle;
    border-color: inherit;
}
thead, th
{
	text-align: left;
	border: 1px solid #4d90fe;
	padding: 8px 12px;
	color: #fff;
    background-color: #6199DF;
	font-weight: bold;
}
td, th
{
	display: table-cell;
}
tbody {
    display: table-row-group;
    vertical-align: middle;
    border-color: inherit;
}
td
{
	padding: 6px 10px;
	border: 1px solid #ddd;
    vertical-align: top;
}

</style>
<div class="docu_content">
<div id="maia-main" class="main">

      <div id="gc-content" class="wide-sidebar" >
       
  <h1 itemprop="name" class="page-title" >Using REST</h1>
  <div itemprop="articleBody"> 
<p class="special">vocaDB API is a <a href="http://www.vocadb.co.kr/developer/pricing.html">paid service</a>. For website dictionary and word extraction from text, we encourage you to use the <a href="http://www.vocadb.co.kr/developer/gadget.html">vocaDB Website Dictionary gadget</a>.</p>
<p>This document describes  how to use the common features of the dictionary and extraction word API using the RESTful calling style.
</p>
<ol class="toc">
  <li><a href="#intro">Introduction</a></li>
  <li><a href="#auth">Identifying your application to vocaDB</a></li>
  <li><a href="#search">Search word or sentences</a>
    <ol>
      <li><a href="#WorkingResults">Working with results</a></li>
      <li><a href="#query-params">Query parameter reference</a></li>
    </ol>
  </li>
   <li><a href="#definition">Definition, Syno, Example</a>
       <ol>
			<li><a href="#definition-Results">Working with results</a></li>
			<li><a href="#definition-query-params">Query parameter reference</a></li>
		</ol>
	<li><a href="#language-params">Language reference</a></li>
</ol>

<h2 style='margin-top:60px' id="intro">Introduction</h2>
<p>This document is intended for developers who want to write applications that can interact with the vocaDB API.  With <a href="http://www.vocadb.co.kr">vocaDB Dictionary</a>, you can programmatically extract words or search dictionary from input in your webpages or apps.</p>

<p>The result of a request to the vocaDB API is a simple JSON object.</p>
<h2 id="auth">Identifying your application to vocaDB</h2>
<p>If you haven't done so already, create your project's API key by following these steps:</p>
<ol>
  <li>
Go to the <a href="http://vocadb.co.kr/developer/apply.html">Contact vocaDB API team</a>.
</li>
<li>Download application form from vocaDB API team</li>
<li>Fill up requirements</li>
<li>Send your application to vocaDB API team</li>
<li>You can get the  <a href="#key">apikey</a> from vocaDB API team</li>

  
</ol>

<h2 style='margin-top:60px' id="search">Search word or sentence(s)</h2>
<h3 id="WorkingResults">Working with results</h3>
<p></p>
<p class="special">You can search word from one language to another language by sending an HTTP <code>GET</code> request to its URI. The URI for a request has the following format:</p>

<pre>http://www.vocadb.co.kr/dic/api_vocadb?<span class="apiparam">parameters</span></pre>
<p>Four query parameters are required with each search request:</p>
<dl>
  <dt>API key</dt>
	<dd>Use the <a href="#key">key</a> query parameter to identify your application.</dd>
	  <dt>source language</dt>
	<dd>Use the <a href="#language-params">slang</a> query parameter to specify the language you want to search into.</dd>
  <dt>Target language</dt>
	<dd>Use the <a href="#language-params">tlang</a> query parameter to specify the language you want to search into.</dd>
  <dt>Source text string</dt>
	<dd>Use the <a href="#q">q</a> query parameter to identify the string to extract or search.</dd>
</dl>
<p>All other <a href="#query-params">query parameters</a> are optional. The URL for the <code>GET</code>, including parameters, must be less than 2K characters.</p>
<p class="note"><strong>Note: </strong>You can also use <code>POST</code> to invoke the API if you want to send more data in a single request. The <code>q</code> parameter in the <code>POST</code> body must be less than 5K characters. To use <code>POST</code>, you must use the <code>X-HTTP-Method-Override</code> header to tell the Translate API to treat the request as a <code>GET</code> (use <code>X-HTTP-Method-Override: GET</code>).</p>
<p>Here is an example that specifies the source language, using the <code>source</code></a> query parameter:</p>
<pre>GET http://www.vocadb.co.kr/dic/api_vocadb?apikey=<span class="apiparam">INSERT-YOUR-KEY</span>&amp;&slang=en&amp;tlang=ko&amp;q=dictionary&amp;output=1&amp;definition=1&amp;ref=1&amp;relative=1&amp;wordlevel=0&amp;part=0&meaning=0&amp;trans=0&amp;elevel=31&amp;portal=1 </pre>
</code>

<p>If the request succeeds, the server responds with a <code>200 OK</code> HTTP status code and the data properties:</p>
<h4>JSON</h4>
<pre style='font-size:90%'>
200 OK
{
    "type": 4,
    "contents": {
        "word": {
            "voca": "dictionary",
            "ilevel": "17",
            "part": "명,동",
            "level": "중입문",
            "pron": "딕션너리",
            "means": "사전",
            "audio": "dictionary",
            "ipa": "dictionary",
            "image": "dictionary",
            "bigimage": "dictionary",
            "definition": "1",
            "synonym": "",
            "example": "1"
        }
    }
}
</pre>


<h3 style='margin-top:60px' id="query-params">Query parameter reference</h3>

<p class="special">The query parameters you can use with the Translate API are summarized in the following table. All parameter values need to be URL encoded.</p>
<div>
<table border="1">
  <thead>
    <tr>
      <th>Classify</th>
      <th>Parameter</th>
	  <th>Expression</th>
	  <th>Value</th>
	  <th>Selection</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td id="dictionary"><code>dictionary</code></td>
	  <td>definition</td>
      <td width='30%'><ul>
        <li>definition</li><li>synonyms</li><li>Example sentences</li>
        </ul></td>
      <td>{ 0 | 1 }</td>
	  
	  <td width='30%'>
	  <input type='radio' name='definition' value='0' checked >Yes
	  <input type='radio' name='definition' value='1' >No</td>
	</tr>
	    <tr>
      <td ><code></code></td>
	  <td>ref</td>
      <td><ul><li>Refer. book</li></ul></td>
      <td>{ 0 | 1 }</td>
	  <td width='30%'>
	  <input type='radio' name='ref' value='0' >Yes
	  <input type='radio' name='ref' value='1' checked >No</td>
	</tr>
	    <tr>
      <td id="Relative word"><code>Relative List</code></td>
	  <td>relative</td>
      <td><ul>
        <li>words & idioms</li></li>
        </ul></td>
      <td>{ 0 | 1 }</td>
	  <td><input type='radio' name='relative' value='0' >Yes
				<input type='radio' name='relative' value='1' checked >No</td>
	</tr>
	    <tr>
      <td id="Relative word"><code></code></td>
	  <td>wordlevel</td>
      <td><ul>
        <li>word's level</li>
        </ul></td>
      <td>{ 0 | 1 }</td>
	  <td><input type='radio' name='wordlevel' value='0' checked >Yes
				<input type='radio' name='wordlevel' value='1'>No</td>
	</tr>	
	    <tr>
      <td id="Relative word"><code></code></td>
	  <td>part</td>
      <td><ul>
        <li>part of speech</li>
        </ul></td>
      <td>{ 0 | 1 }</td>
	  <td><input type='radio' name='part' value='0' checked >Yes
				<input type='radio' name='part' value='1'>No</td>
	</tr>	
	    <tr>
      <td id="Relative word"><code></code></td>
	  <td>relative</td>
      <td><ul>
        <li>meaning of word</li>
        </ul></td>
      <td>{ 0 | 1 }</td>
	  <td><input type='radio' name='meaning' value='0' checked >Yes
				<input type='radio' name='meaning' value='1'>No</td>
	</tr>
	    <tr>
      <td id="extraction"><code>extraction</code></td>
	  <td>trans</td>
      <td><ul><li>input type</li></ul></td>
      <td>{ 0 | 1 | 2}</td>
	  <td><input type='radio' name='trans' value='0' checked >Auto<br>
				<input type='radio' name='trans' value='1'  >Dictionary<br>
				<input type='radio' name='trans' value='2'>Sentences</td>
	</tr>
		    <tr>
      <td ><code></code></td>
	   <td>Extract Level</td>
      <td><ul><li>extract level</li></ul></td>
      <td>{ 9 | 41 | 33 | 32 | 31 | 23 | 22 | 21 | 13 | 1 }</td>
	  <td><select name='elevel' style='border-radius:5px;border:1px solid #cccccc; width:90%' > 
				<option value='9' >Auto</option> 
				<option value='41' >Collage</option> <option value='33' >High 3 </option> <option value='32'>High 2</option> <option value='31' selected>High 1</option> 
				<option value='23'>Middle 3</option> <option value='22'> Middle 2</option> <option value='21'> Middle 1</option> <option value='13'> Elementary </option>
				<option value='1'> Nothing </option>
			</select></td>
	  
	</tr>
	    <tr>
      <td id="Portal"><code>I'm</code></td>
	  <td>portal</td>
      <td><ul><li>Portal</li></ul></td>
      <td>{ 0 | 1}</td>
	  <td><input type='radio' name='portal' value='0'  >Yes
				<input type='radio' name='portal' value='1' checked >Nos</td>
	</tr>	
	</tbody>
</table>
<table border="1">
  <thead>
    <tr>
      <th>Parameter</th>
      <th>Meaning</th>
      <th>Notes</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td id="callback"><code>callback</code></td>
      <td>A JavaScript function to run when the response is received</td>
      <td><ul>
        <li>This optional parameter allows you to specify a JavaScript function
          to handle query results for pure client-side implementations. </li>
        <li>Embed the API query in <code>&lt;script&gt;</code> tags.</li>
        <li>Define the callback function in <code>&lt;script&gt;</code> tags. </li>
       
        </ul></td>
    </tr>
    <tr>
      <td id="apikey"><code>APIkey</code></td>
      <td>Your API key</td>
      <td><ul>
        <li>This API requires a valid key for all requests</li>
       
        </ul></td>
    </tr>

    <tr>
      <td id="q"><code>q</code></td>
      <td>search word, sentence(s)</td>
      <td><ul>
        <li>The text to be searched or extracted word list. </li>
        <li>You can repeat this parameter more than once in a single request to translate or extract
          multiple texts.</li>
        </ul></td>
    </tr>
    <tr>
      <td id="slang"><code>slang</code></td>
      <td>Source language</td>
      <td>
        <ul>
          <li>The language of the source text. The value should be one of the language codes
            listed in <a href="#language-params">Language reference</a>. </li>
          <li>If a language is not
            specified, the system will attempt to identify the source language automatically. </li>
          </ul>
        </td>
    </tr>
    <tr>
      <td id="tlang"><code>tlang</code></td>
      <td>Target language</td>
      <td>
        <ul>
          <li>The language to search or extract word list from the source text into. The value should be one of
          the language codes listed in <a href="#language-params">Language reference</a>
          </li>
        </ul>
      </td>
    </tr>

  </tbody>
</table>

<h3 id="query-params">Apikey</h3>
<table border="1">
  <thead>
    <tr>
      <th>Apikey</th>
      <th>Parameter</th>
	  <th>Value</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td id="apikey"><code>apikey</code></td>
	  <td>apikey</td>
      <td width='30%'>Oauth</td>
      <td>16 charecters</td>

	</tr>
	</tbody>
</table>	
<h3 id="query-params">Languages and Input word</h3>
<table border="1">
  <thead>
    <tr>
      <th>Language</th>
      <th>Parameter</th>
	  <th>Value</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td id="apikey">source</td>
	  <td>slang</td>
      <td width='30%'><a href="#language-params">Language reference</a></td>
      <td width='30%'>24 Languages</td>
	</tr>
    <tr>
      <td id="apikey">target</td>
	  <td>tlang</td>
      <td width='30%'><a href="#language-params">Language reference</a></td>
      <td width='30%'>24 Languages</td>
	</tr>
    <tr>
      <td id="apikey">input</td>
	  <td>q</td>
      <td width='30%'>search word</td>
      <td width='30%'>a word, sentence(s)</td>
	</tr>	
	</tbody>
</table>	
<h3 id="query-params">Sample API</h3>
<table border="1">
  <thead>
    <tr>
      <th>Cases</th>
      <th>Example</th>
	  <th>Value</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td id="apikey">a word</td>
	  <td>arrest</td>
      <td >English</td>
      <td >Search word</td>
	</tr>
    <tr>
      <td id="apikey">a word</td>
	  <td>성공, 逮捕</td>
      <td >24 Languages</td>
      <td >Search word</td>
	</tr>
    <tr>
      <td id="apikey">words with space</td>
	  <td>in order to</td>
      <td >English</td>
      <td >with space</td>
	</tr>	
    <tr>
      <td width='20%'>sentence(s)</td>
	  
      <td width='40%'>The financial crisis is considered by many economists to be the worst financial crisis</td>
	  <td width='15%'>English</td>
      <td width='20%' >limit 1000 letters</td>
	</tr>		
	</tbody>
</table>	

<h3 id="query-params">Result Value of API</h3>
<p class="special">Returned JSON format : 
 <pre>
 { 
	"<b>type</b>": {0 | 1 | 2 | 3 | 4} ,
	"<b>contents</b>": { 0 | -1 | -2 | -3 | [words] | [idioms] }
 }
 </pre></p>
<ul>

<li><b>JSON format </b></li>
<p>
The result consists of types and contents parts. <br>
Example, {"type":4,"contents":0} the contents part of words have four sub contents which are words, idioms, notfound and new_words.</p>
<li><b>Value of Type</b></li>
<table border="1">
  <thead>
    <tr>
      <th>Value of Type</th>
      <th>Meaning</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>0</td>
	  <td>no authority</td>
      <td >Reject</td>
	</tr>
    <tr>
      <td >1</td>
	  <td>Extrction for sentence(s)</td>
      <td >5 Groups :<br> trans, { [words] | [idioms] }, Newwords, Notfound</td>

	</tr>
    <tr>
      <td >2</td>
	  <td>for an idiom</td>
	  <td></td>

	</tr>	
    <tr>
      <td >3</td>
      <td >for non-English words such as 成功, 最高, 성공</td>
		<td>{ [words] | [idioms] }</td>
	</tr>		
	    <tr>
      <td >4</td>
      <td >for a normal word</td>
		<td>{ [words] }</td>
	</tr>	
	</tbody>
</table>
<li><b>Value of Contents illegally</b></li>
<table border="1">
  <thead>
    <tr>
      <th>Value of Contents</th>
      <th>Format</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width='20%'>-1</td>
	  <td> {"type":0,"contents":-1}</td>
      <td >no authority </td>
	</tr>  

    <tr>
      <td >-2</td>
	  <td> {"type":3,"contents":-2}</td>
      <td >Non-English word's length must have mininum 6 bytes (2 letters) for example, 눈 or 捕</td>

	</tr>
    <tr>
      <td >-3</td>
	  <td>{"type":3,"contents":-3}</td>
	  <td> a restricted word of input word in non-English, Korean <br>
	  for examples - "이다", "する"  </td>

	</tr>	

	</tbody>
</table>
<li><b>Input sentence(s)</b></li>
<table border="1">
  <thead>
    <tr>
      <th>Type</th>
      <th>Contents</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width='20%'>1</td>
	  <td>
<pre style='font-size:90%'> 
    "trans": {
            "count": 36,
            "letters": 186
        },	  
	  </pre></td>
      <td > Count is number of word <br>
	  Letters are number of letter 
	  
</td>
	</tr>
    <tr>
      <td ></td>
	  <td> {  [words]  |  [idioms]  }</td>
      <td >Extracted word list from input text</td>
	</tr>
    <tr>
      <td ></td>
	  <td> {  "words": 0,  "idioms": 0 }</td>
      <td >Nothing extracted word list from input text</td>
	</tr>	
	</tbody>
</table>

<li><b>Nothing Result : Contents = 0</b></li>
<table border="1">
  <thead>
    <tr>
      <th>Input</th>
      <th>JSON</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width='20%'>arrestingsil</td>
	  <td> {"type":4,"contents":0}</td>
      <td >Word does not exist. </td>
	</tr>
    <tr>
      <td >가나다라</td>
	  <td> {"type":3,"contents":0}</td>
      <td >Non-English word  does not exist </td>
	</tr>
	</tbody>
</table>
<li><b>Query of "arrest" : consist of contents part</b></li>

<pre>
GET http://www.vocadb.co.kr/dic/api_vocadb?apikey=<i>INSERT-YOUR-KEY</i>&slang=en&tlang=ko&q=arrest&output=1&definition=1&ref=1&relative=1&wordlevel=0&part=0&meaning=0&trans=0&elevel=31&portal=1 
</pre>

<table border="1">
  <thead>
    <tr>
      <th>Type</th>
      <th>Group</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width='20%'>4</td>
	  <td>word</td>
      <td>arrary type, include a word or several words</td>
	</tr>
	</tbody>
</table>
<table border="1">
  <thead>
    <tr>
      <th>Parameters</th>
      <th>Return Values</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width='20%'>voca</td>
      <td> "arrest",</td>
	  <td> searched word</td>
	</tr>
	    <tr>
      <td width='20%'>ilevel</td>
	  <td> "22",</td>
	  <td>level of searched word</td>
	</tr>
	    <tr>
      <td width='20%'>part</td>
      <td> "명,동",</td>
	  <td>part of speech </td>
	</tr>
	    <tr>
      <td width='20%'>level</td>
      <td> "중2",</td>
	  <td>level of searched word in Korean (depends on language)</td>
	</tr>
	    <tr>
      <td width='20%'>pron</td>
      <td> "어레스트",</td>
	  <td>pronounciation of korean (depends on language)</td>
	</tr>
	    <tr>
      <td width='20%'>means</td>
      <td> "1. 체포, 검거 2. 체포하다, 검거하다 3. 억류하다"</td>
	  <td>meaning of searched word</td>
	</tr>
    <tr>
      <td width='20%'>audio</td>
      <td> "arrest",</td>
	  <td>audio file name of searched word</td>
	</tr>
	    <tr>
      <td width='20%'>ipa</td>
	  <td> "arrest",</td>
	  <td>file name of ipa image  of searched word</td>
	</tr>
	    <tr>
      <td width='20%'>image</td>
      <td> "arrest",</td>
	  <td>file name of image of searched word</td>
	</tr>
	    <tr>
      <td width='20%'>bigimage</td>
      <td> "arrest",</td>
	  <td>big image of searched word for learning</td>
	</tr>
	    <tr>
      <td width='20%'>definition</td>
      <td> "1",</td>
	  <td>"1" means definition of searched word exist</td>
	</tr>
	    <tr>
      <td width='20%'>synonym</td>
      <td> "1",</td>
	  <td>"1" means synonym of searched word exist</td>
	</tr>	
		    <tr>
      <td width='20%'>example</td>
      <td> "1",</td>
	  <td>"1" means example sentence(s) of searched word exist, "0" does not exist</td>
	</tr>	
	</tbody>
</table>

<li><B>Input : "arrest" ,  Result : &quot; type&quot; = 4</b></li>
<pre style='font-size:90%'>
200 OK
{
	&quot;type&quot;: 4,
	&quot;contents&quot;: {
		&quot;words&quot;: {
	            &quot;voca&quot;: &quot;arrest&quot;,
	            &quot;ilevel&quot;: &quot;22&quot;,
	            &quot;part&quot;: &quot;명,동&quot;,
	            &quot;level&quot;: &quot;중2&quot;,
	            &quot;pron&quot;: &quot;어레스트&quot;,
	            &quot;means&quot;: &quot;1. 체포, 검거  2. 체포하다, 검거하다  3. 억류하다&quot;,
	            &quot;audio&quot;: &quot;arrest&quot;,
	            &quot;ipa&quot;: &quot;arrest&quot;,
	            &quot;image&quot;: &quot;arrest&quot;,
	            &quot;bigimage&quot;: &quot;arrest&quot;,
	            &quot;definition&quot;: &quot;1&quot;,
	            &quot;synonym&quot;: &quot;1&quot;,
	            &quot;example&quot;: &quot;1&quot;
	        }
	}
}
</pre>

<li><b>input : &quot;in order to&quot;, Result : &quot;type&quot; = 2</b></li>
<pre style='font-size:90%'>
{
    <b>&quot;type&quot;: 2</b>,
    <b>&quot;contents&quot;</b>: [
        {
            &quot;idiom&quot;: &quot;in order to&quot;,
            &quot;ilevel&quot;: &quot;22&quot;,
            &quot;level&quot;: &quot;중2&quot;,
            &quot;means&quot;: &quot;1. ~하기 위하여  2. ~할 목적으로&quot;,
            &quot;audio&quot;: &quot;in order to&quot;
            &quot;image&quot;: &quot;&quot;,
            &quot;bigimage&quot;: &quot;&quot;,
            &quot;definition&quot;: &quot;&quot;,
            &quot;synonym&quot;: &quot;&quot;,
            &quot;example&quot;: &quot;1&quot;			
        }
    ]
}	
</pre>
<li>
<b>input Sentences : , Result : &quot;type&quot; = 1</b></li>
<p class='word_means'> The late-2000s financial crisis (often called the global recession , global financial crisis or the credit crunch ) is considered by many economists to be the worst financial crisis since the Great Depression of the 1930s.</p>
<pre style='font-size:90%'>
{
    <b>&quot;type&quot;: 1</b>,
    <b>&quot;contents&quot;</b>: {
        <b>&quot;trans&quot;</b>: {
            &quot;count&quot;: 36,
            &quot;letters&quot;: 186
        },
       <b> &quot;words&quot;</b>: [
            {
                &quot;voca&quot;: &quot;crunch&quot;,
                &quot;ilevel&quot;: &quot;42&quot;,
                &quot;part&quot;: &quot;명,동&quot;,
                &quot;means&quot;: &quot;1. 위기(의), 중대한  2. 오독오독 깨물다, 저벅저벅 밟다  3. (구어) 핵심, 결정적시기&quot;,
                &quot;level&quot;: &quot;고급&quot;,
                &quot;audio&quot;: &quot;crunch&quot;,
                &quot;origin&quot;: &quot;crunch&quot;
            },
            {
                &quot;voca&quot;: &quot;recession&quot;,
                &quot;ilevel&quot;: &quot;42&quot;,
                &quot;part&quot;: &quot;명&quot;,
                &quot;means&quot;: &quot;일시적인 경기 후퇴, 불황&quot;,
                &quot;level&quot;: &quot;고급&quot;,
                &quot;audio&quot;: &quot;recession&quot;,
                &quot;origin&quot;: &quot;recession&quot;
            },
            {
                &quot;voca&quot;: &quot;credit&quot;,
                &quot;ilevel&quot;: &quot;31&quot;,
                &quot;part&quot;: &quot;명,동&quot;,
                &quot;means&quot;: &quot;1. 신용, 신뢰, 명성  2. 믿다, 입금하다  3. (세금)공제액, 신용거래&quot;,
                &quot;level&quot;: &quot;고1&quot;,
                &quot;audio&quot;: &quot;credit&quot;,
                &quot;origin&quot;: &quot;credit&quot;
            },
            {
                &quot;voca&quot;: &quot;economist&quot;,
                &quot;ilevel&quot;: &quot;31&quot;,
                &quot;part&quot;: &quot;명&quot;,
                &quot;means&quot;: &quot;경제학자&quot;,
                &quot;level&quot;: &quot;고1&quot;,
                &quot;audio&quot;: &quot;economist&quot;,
                &quot;origin&quot;: &quot;economist&quot;
            }
        ],

       <b> &quot;idioms&quot;</b>: [
            {
                &quot;idiom&quot;: &quot;A be considered by B to be&quot;,
                &quot;ilevel&quot;: &quot;32&quot;,
                &quot;level&quot;: &quot;고2&quot;,
                &quot;means&quot;: &quot;1. A는 B에 의해 ~로 간주된다  2. B는 A를 (to be) ~로 여긴다&quot;,
                &quot;audio&quot;: &quot;A be considered by B to be&quot;
            },
            {
                &quot;idiom&quot;: &quot;credit crunch&quot;,
                &quot;ilevel&quot;: &quot;42&quot;,
                &quot;level&quot;: &quot;고급&quot;,
                &quot;means&quot;: &quot;1. 신용경색  2. 신용규제&quot;,
                &quot;audio&quot;: &quot;credit crunch&quot;
            },
            {
                &quot;idiom&quot;: &quot;Great Depression&quot;,
                &quot;ilevel&quot;: &quot;32&quot;,
                &quot;level&quot;: &quot;고2&quot;,
                &quot;means&quot;: &quot;(1930년대 세계) 대공황&quot;,
                &quot;audio&quot;: &quot;Great Depression&quot;
            }
        ]
    }
}	
</pre>
<li><b>input : &quot;성공&quot;, Result : &quot;type&quot;= 3</b> </li>
<pre style='font-size:90%'>
{
    <b>&quot;type&quot;: 3</b>,
    <b>&quot;contents&quot;: </b>{
        <b>&quot;words&quot;:</b> [
            {
                &quot;voca&quot;: &quot;succeed&quot;,
                &quot;ilevel&quot;: &quot;22&quot;,
                &quot;part&quot;: &quot;동&quot;,
                &quot;means&quot;: &quot;성공하다&quot;,
                &quot;level&quot;: &quot;중2&quot;,
                &quot;audio&quot;: &quot;succeed&quot;
            },
            {
                &quot;voca&quot;: &quot;success&quot;,
                &quot;ilevel&quot;: &quot;22&quot;,
                &quot;part&quot;: &quot;명&quot;,
                &quot;means&quot;: &quot;성공&quot;,
                &quot;level&quot;: &quot;중2&quot;,
                &quot;audio&quot;: &quot;success&quot;
            },
            {
                &quot;voca&quot;: &quot;successful&quot;,
                &quot;ilevel&quot;: &quot;22&quot;,
                &quot;part&quot;: &quot;형&quot;,
                &quot;means&quot;: &quot;성공한, 성공적인&quot;,
                &quot;level&quot;: &quot;중2&quot;,
                &quot;audio&quot;: &quot;successful&quot;
            },
            {
                &quot;voca&quot;: &quot;successfully&quot;,
                &quot;ilevel&quot;: &quot;22&quot;,
                &quot;part&quot;: &quot;부&quot;,
                &quot;means&quot;: &quot;성공적으로&quot;,
                &quot;level&quot;: &quot;중2&quot;,
                &quot;audio&quot;: &quot;successfully&quot;
            },
            {
                &quot;voca&quot;: &quot;prosper&quot;,
                &quot;ilevel&quot;: &quot;23&quot;,
                &quot;part&quot;: &quot;동&quot;,
                &quot;means&quot;: &quot;1. 번영하다  2. 성공하다&quot;,
                &quot;level&quot;: &quot;중3&quot;,
                &quot;audio&quot;: &quot;prosper&quot;
            }
        ],
        <b>&quot;idioms&quot;:</b> [
            {
                &quot;idiom&quot;: &quot;do well&quot;,
                &quot;ilevel&quot;: &quot;21&quot;,
                &quot;level&quot;: &quot;중1&quot;,
                &quot;means&quot;: &quot;1. 잘 되다  2. 성공하다&quot;,
                &quot;audio&quot;: &quot;do well&quot;
            },
            {
                &quot;idiom&quot;: &quot;get ahead&quot;,
                &quot;ilevel&quot;: &quot;22&quot;,
                &quot;level&quot;: &quot;중2&quot;,
                &quot;means&quot;: &quot;성공하다&quot;,
                &quot;audio&quot;: &quot;get ahead&quot;
            },
            {
                &quot;idiom&quot;: &quot;be a huge success&quot;,
                &quot;ilevel&quot;: &quot;23&quot;,
                &quot;level&quot;: &quot;중3&quot;,
                &quot;means&quot;: &quot;큰 성공을 거두다&quot;,
                &quot;audio&quot;: &quot;be a huge success&quot;
            }
        ]
    }
}
</pre>
</ul>


<div style='margin:0 auto; float :right; margin-bottom:50px'>
<button style='width=50%; padding:10px; font-size:120%; background-color:#f2f2f2; border-radius:6px;  '><a href='http://www.vocadb.co.kr/api/api_vocadb.html' target='_blank'>Training vocaDB API</a></button> </div>

<div class="panel-body">
<h3 id="language-params" style='margin-top:60px;'>Language reference</h3>
<p>Following is a partial list of supported languages and their codes:</p>
<table border="1">
  <thead>
    <tr>
      <th>Language</th>
      <th>Language code</th>
    </tr>
  </thead>
  <tbody>
<tr><td>English</td><td><code>en</code></td></tr>
<tr><td>Arabic </td><td><code>ar</code></td></tr>
<tr><td>Korean </td><td><code>ko</code></td></tr>
<tr><td>Japanese </td><td><code>ja</code></td></tr>
<tr><td>Chinese Tradi </td><td><code>zh-TW</code></td></tr>
<tr><td>Chinese simp </td><td><code>zh-CN</code></td></tr>
<tr><td>Arabic </td><td><code>ar</code></td></tr>
<tr><td>Armenian </td><td><code>hy</code></td></tr>
<tr><td>Bengali </td><td><code>bn</code></td></tr>
<tr><td>Bulgarian </td><td><code>bg</code></td></tr>
<tr><td>Croatian </td><td><code>hr</code></td></tr>
<tr><td>Czech </td><td><code>cs</code></td></tr>
<tr><td>Danish </td><td><code>da</code></td></tr>
<tr><td>Dutch </td><td><code>nl</code></td></tr>
<tr><td>Filipino </td><td><code>tl</code></td></tr>
<tr><td>Finnish </td><td><code>fi</code></td></tr>
<tr><td>French </td><td><code>fr</code></td></tr>
<tr><td>Georgian </td><td><code>ka</code></td></tr>
<tr><td>German </td><td><code>de</code></td></tr>
<tr><td>Greek </td><td><code>el</code></td></tr>
<tr><td>Hindi </td><td><code>hi</code></td></tr>
<tr><td>Hungarian </td><td><code>hu</code></td></tr>
<tr><td>Indonesian </td><td><code>id</code></td></tr>
<tr><td>Italian </td><td><code>it</code></td></tr>
<tr><td>Malay </td><td><code>ms</code></td></tr>
<tr><td>Norwegian </td><td><code>no</code></td></tr>
<tr><td>Persian </td><td><code>fa</code></td></tr>
<tr><td>Polish </td><td><code>pl</code></td></tr>
<tr><td>Portuguese </td><td><code>pt</code></td></tr>
<tr><td>Romanian </td><td><code>ro</code></td></tr>
<tr><td>Russian </td><td><code>ru</code></td></tr>
<tr><td>Slovenian </td><td><code>sl</code></td></tr>
<tr><td>Spanish </td><td><code>es</code></td></tr>
<tr><td>Swedish </td><td><code>sv</code></td></tr>
<tr><td>Tamil </td><td><code>ta</code></td></tr>
<tr><td>Thai </td><td><code>th</code></td></tr>
<tr><td>Turkish </td><td><code>tr</code></td></tr>
<tr><td>Ukrainian </td><td><code>uk</code></td></tr>
<tr><td>Vietnamese </td><td><code>vi</code></td></tr>

  </tbody>
</table>
<p> updated on July 5, 2015</p>


	
</div>
</div>


<h2 style='margin-top:0px' id="definition">Definition, Synonym, Example Sentences</h2>
<h3 id="definition-Results">Working with results</h3>
<p></p>
<p class="special">You can search word from one language to another language by sending an HTTP <code>GET</code> request to its URI. The URI for a request has the following format:</p>

<pre>http://www.vocadb.co.kr/dic/api_example_defintion.php?<span class="apiparam">parameters</span></pre>
<p>Four query parameters are required with each search request:</p>
<dl>
  <dt>API key</dt>
	<dd>Use the <a href="#key">key</a> query parameter to identify your application.</dd>
  <dt>User's English level</dt>
	<dd>Use the <a href="#language-params">level</a> query parameter to specify user's English level you want to search into.</dd>
  <dt>Request Type</dt>
	<dd>Use the <a href="#language-params">def_syn</a> query parameter to specify the request type among the three types you want to search into.</dd>
  <dt>Request word</dt>
	<dd>Use the <a href="#q">q</a> query parameter to identify the string to extract or search.</dd>
</dl>
<p>All other <a href="#definition-query-params">query parameters</a> are optional. The URL for the <code>GET</code>, including parameters.</p>
<p class="note"><strong>Note: </strong>You can also use <code>POST</code> to invoke the API if you want to send more data in a single request. The <code>q</code> parameter in the <code>POST</code> body must be less than 5K characters. To use <code>POST</code>, you must use the <code>X-HTTP-Method-Override</code> header to tell the Translate API to treat the request as a <code>GET</code> (use <code>X-HTTP-Method-Override: GET</code>).</p>
<p>Here is an example that specifies the requesting query, using the <code>source</code></a> query parameter:</p>
<pre>GET http://www.vocadb.co.kr/dic/api_example_definition.php?level=22&amp;apikey=<span class="apiparam">INSERT-YOUR-KEY</span>&amp;def_syn=1&amp;q=arrest</pre>
</code>


<h3 style='margin-top:60px' id="definition-query-params">Query parameter reference</h3>

<p class="special">The query parameters you can use with the Translate API are summarized in the following table. All parameter values need to be URL encoded.</p>
<div>

<table border="1">
  <thead>
    <tr>
      <th>Parameter</th>
      <th>Meaning</th>
      <th>Notes</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td id="callback"><code>callback</code></td>
      <td>A JavaScript function to run when the response is received</td>
      <td><ul>
        <li>This optional parameter allows you to specify a JavaScript function
          to handle query results for pure client-side implementations. </li>
        <li>Embed the API query in <code>&lt;script&gt;</code> tags.</li>
        <li>Define the callback function in <code>&lt;script&gt;</code> tags. </li>
        
        </ul></td>
    </tr>
    <tr>
      <td id="apikey"><code>APIkey</code></td>
      <td>Your API key</td>
      <td><ul>
        <li>This API requires a valid key for all requests</li>
      
        </ul></td>
    </tr>

    <tr>
      <td id="q"><code>q</code></td>
      <td>search word</td>
      <td><ul>
        
        <li>You can repeat this parameter more than once in a single request to translate or extract
          multiple texts.</li>
        </ul></td>
    </tr>
    <tr>
      <td id="level"><code>level</code></td>
      <td>level</td>
      <td>
        <ul>
          <li>The levle of user's English. </li>
          <li> This is consist of middle or high school English level</li>
		  <li> This parameter is used for examples only </li>
          </ul>
        </td>
    </tr>
    <tr>
      <td id="type"><code>Type</code></td>
      <td>Request type</td>
      <td>
        <ul>
          <li>API services one of the definition, synonym or example for requesting word.</a>
          </li>
        </ul>
      </td>
    </tr>

  </tbody>
</table>

<h3 id="query-params">Apikey</h3>
<table border="1">
  <thead>
    <tr>
      <th>Apikey</th>
      <th>Parameter</th>
	  <th>Value</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td id="apikey"><code>apikey</code></td>
	  <td>apikey</td>
      <td width='30%'>Oauth</td>
      <td>16 charecters</td>

	</tr>
	</tbody>
</table>	



<h3 id="query-params">Result Value of API</h3>
<p class="special">Returned JSON format : 
 <pre>
 { 
	"<b>type</b>": { -1 | 1 | 2 | 3 } ,
	"<b>search</b>": { reqested word }
	"<b>contents</b>": { [level | grade | book | example] | [level | example] | "" }
 }
 </pre></p>
<ul>

<li><b>JSON format </b></li>
<p>
The result consists of types and contents parts. 
</p>
<li><b>Value of Type</b></li>
<table border="1">
  <thead>
    <tr>
      <th>Value of Type</th>
      <th>Meaning</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>-1</td>
	  <td>no authority</td>
      <td >Wrong Apikey : {"type":-1,"search":"arrest","contents":"Wrong APIkey"}</td>
	</tr>
    <tr>
      <td>0</td>
	  <td>empty</td>
      <td >Request word is empty. {"type":0,"contents":""} </td>
	</tr>	
    <tr>
      <td >1</td>
	  <td>definitions </td>
      <td > [level | example] <br>
	  level : level of word's level - Middle or High school<br>
		example : word's definition<br></td>

	</tr>
    <tr>
      <td >2</td>
	  <td>synonyms</td>
	  <td>[level | example]<br>
	  level : [ "" | ant ]<br>
	  "" : synonym<br>
	  "ant" : antonym<br>
		example : synonym or antonym words<br></td>

	</tr>	
    <tr>
      <td >3</td>
      <td >examples</td>
		<td>[level | grade | book | example] <br>
		level : level of example sentence - Middle or High school<br>
		grade : School grade<br>
		book : textbook name<br>
		example : example sentence<br><br>
		<b> restrict word's example sentences : [ Middle | High ]</b>
		<br>
		Example sentences have a lot in DB so lower level word is no need to service more then middle level.
		</td>
	</tr>		
	   
	</tbody>
</table>

<li><b>Nothing Result : Contents = ""</b></li>
<table border="1">
  <thead>
    <tr>
      <th>Input</th>
      <th>JSON</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width='20%'>arrestingsil</td>
	  <td> {"type":1,"contents":""}</td>
      <td >Word's definition does not exist. </td>
	</tr>
    <tr>
      <td >가나다라</td>
	  <td> {"type":2,"contents":""}</td>
      <td >Word's synonym does not exist </td>
	</tr>
    <tr>
      <td >ksdldi</td>
	  <td> {"type":3,"contents":""}</td>
      <td >Word's examples does not exist </td>
	</tr>
	</tbody>
</table>
<!--
<div style='margin:0 auto; float :right; margin-bottom:50px'>
<button style='width=50%; padding:10px; font-size:120%; background-color:#f2f2f2; border-radius:6px;  '><a href='http://www.vocadb.co.kr/api/api_example_defintion.html' target='_blank'>Training Defintion API</a></button> 
</div>-->

<br>
<li><b>Query of "arrest" : consist of contents part</b></li>
<p class="special">Example JSON Results </p>

<li><B>Input : "arrest" ,  Result : &quot; type&quot; = 1</b></li>
<p>If the request succeeds, the server responds with a <code>200 OK</code> HTTP status code and the data properties for <b>word's definition:</b></p>
<h4>JSON</h4>
<pre style='font-size:90%'>
200 OK
{
    "type": "1",
    "search": "arrest",
    "contents": [
        {
            "level": "D",
            "example": "to catch and hold someone because he has broken a law"
        },
        {
            "level": "D",
            "example": "to seize a person for legal action; to take as a prisoner"
        }
    ]
}
</pre>

<li><B>Input : "arrest" ,  Result : &quot; type&quot; = 2</b></li>
<p>If the request succeeds, the server responds with a <code>200 OK</code> HTTP status code and the data properties for <b>word's synonyms:</b></p>
<h4>JSON</h4>
<pre style='font-size:90%'>
200 OK
{
    "type": "2",
    "search": "arrest",
    "contents": [
        {
            "level": "",
            "example": "seize, apprehend, capture"
        },
        {
            "level": "",
            "example": "seize, take, stop, capture, withhold, restrain, hold, detain, apprehend"
        },
        {
            "level": "ant",
            "example": "release, dismiss"
        }
    ]
}
</pre>
<li><B>Input : "arrest" ,  Result : &quot; type&quot; = 3</b></li>
<p>If the request succeeds, the server responds with a <code>200 OK</code> HTTP status code and the data properties for <b>word's examples:</b></p>
<h4>JSON</h4>
<pre style='font-size:90%'>
200 OK
{
    "type": "3",
    "search": "arrest",
    "contents": [
        {
            "level": "MID",
            "grade": "2",
            "book": "Didimdol_Kim",
            "example": "At the news of Rosa Parks' arrest, the black people got upset and started a bus boycott."
        },
        {
            "level": "MID",
            "grade": "2",
            "book": "Didimdol_Kim",
            "example": "At the news of Rosa Parks' arrest, the black people got upset and started a bus boycott."
        },
        {
            "level": "MID",
            "grade": "3",
            "book": "Jihaksa",
            "example": "You're under arrest."
        },
        {
            "level": "MID",
            "grade": "3",
            "book": "Jihaksa",
            "example": "Under arrest?"
        },
        {
            "level": "MID",
            "grade": "3",
            "book": "Jihaksa",
            "example": "You're under arrest."
        },
        {
            "level": "MID",
            "grade": "3",
            "book": "Jihaksa",
            "example": "Under arrest?"
        },
        {
            "level": "MID",
            "grade": "2",
            "book": "Didimdol_Kim",
            "example": "The driver called the police, and she was arrested."
        },
        {
            "level": "MID",
            "grade": "2",
            "book": "Didimdol_Kim",
            "example": "The driver called the police, and she was arrested."
        },
        {
            "level": "MID",
            "grade": "3",
            "book": "Accom",
            "example": "But at last he was arrested, thanks to the dog."
        },
        {
            "level": "MID",
            "grade": "3",
            "book": "Accom",
            "example": "She arrested the man."
        }
    ]
}
</pre>


</div>
</div>
</div>
</div>
</div>


