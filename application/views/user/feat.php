<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<style>
#storage
{
	color: #222;
    font-family: Roboto, sans-serif;
    font-size: 14px;
    -webkit-font-smoothing: antialiased;
    font-weight: 400;
    line-height: 1.6;
	display:block;
}
.column {
    display: inline-block;
    width: 46.5%;
    vertical-align: top;
    padding: 0 0.5em;
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
#documentation h4 {
    position: relative;
    padding-left: 72px;
    white-space: nowrap;
    font-weight: 600;
    margin-bottom: 1.8em;
}
h4
{
	position: relative;
    padding-left: 72px;
    white-space: nowrap;
    font-weight: 600;
    margin-bottom: 1.8em;
	    color: #333;
    font-size: 18px;
    font-weight: 500;
    line-height: 1.3;
    margin: 24px 0 14px 0;
	    display: block;
    -webkit-margin-before: 1.33em;
    -webkit-margin-after: 1.33em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    font-weight: bold;
}
p {
    display: block;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
	
}
#gc-content ol.toc {
    list-style-type: none;
}
.toc {
    padding-left: 20px;
    margin-left: 0px;
	font-weight: bold;
	font-size: 14px;
}
.toc li a:hover
{
	text-decoration: none;
}

#storage ul, ol {
    margin: 10px 10px 10px 30px;
    padding: 0;
}
#storage ol {
    display: block;
    list-style-type: none;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    -webkit-padding-start: 40px;
}
.voca_img
{
	width: 90px;
	height: 90px;
	border-radius: 40%;
}
</style>
<section id="storage">
      <h2>VocaDB API</h2>
      <hr>

      <div class="column" id="cloud-sql">
        <h4><img class="voca_img" src="<?php echo base_url().'resources/images/logo_icon_white copy.png'; ?>">Dictionary</h4>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <ol class="toc">
          <li><a href="/sql/docs/introduction">Overview</a></li>
          <li><a href="/sql/docs/getting-started">Tutorial</a></li>
          <li><a href="/sql/docs">Documentation</a></li>
        </ol>
      </div>

      <div class="column" id="cloud-storage">
        <h4><img class="voca_img" src="<?php echo base_url().'resources/images/logo_icon_white copy.png'; ?>">Definition, Synonyms, Examples</h4>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <ol class="toc">
          <li><a href="/storage/docs/overview">Overview</a></li>
          <li><a href="/storage/docs/signup">Tutorial</a></li>
          <li><a href="/storage/docs">Documentation</a></li>
        </ol>
      </div>

      <div class="column" id="cloud-datastore">
        <h4><img class="voca_img" src="<?php echo base_url().'resources/images/logo_icon_white copy.png'; ?>">Translation to Google,MS</h4>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <ol class="toc">
          <li><a href="/datastore/docs/concepts/overview">Overview</a></li>
          <li><a href="/datastore/docs/getstarted/overview">Tutorial</a></li>
          <li><a href="/datastore/docs">Documentation</a></li>
         </ol>
      </div>

      <div class="column" id="cloud-bigtable">
        <h4><img class="voca_img" src="<?php echo base_url().'resources/images/logo_icon_white copy.png'; ?>">Extract Words, Idioms</h4>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <ol class="toc">
          <li><a href="/bigtable/docs/api-overview">Overview</a></li>
          <li><a href="/bigtable/docs/hbase-shell-quickstart">Tutorial</a></li>
          <li><a href="/bigtable/docs">Documentation</a></li>
        </ol>
      </div>

      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. see <a href="storing-your-data.html">Storing Your Data</a>.
      </p>
    </section>