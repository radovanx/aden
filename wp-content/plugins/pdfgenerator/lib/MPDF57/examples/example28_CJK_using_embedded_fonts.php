<?php

ini_set("memory_limit", "256M");


$html = "

<style>
p { text-align: justify; }
td { text-align: justify; }
</style>
<h1>mPDF</h1>
<h2>CJK Languages</h2>


<bookmark content=\"\xe3\x81\x82\xe3\x82\x81 \xe3\x81\xa4\xe3\x81\xa1\">

<h4>Japanese (pangrams)</h4>
<h5>Iroha Uta </h5>

<p style=\"font-family: IPAMinchoP\">\xe3\x81\x84\xe3\x82\x8d\xe3\x81\xaf\xe3\x81\xab\xe3\x81\xbb\xe3\x81\xb8\xe3\x81\xa8\xe3\x80\x80\xe3\x81\xa1\xe3\x82\x8a\xe3\x81\xac\xe3\x82\x8b\xe3\x82\x92\xe3\x80\x80\xe3\x82\x8f\xe3\x81\x8b\xe3\x82\x88\xe3\x81\x9f\xe3\x82\x8c\xe3\x81\x9d\xe3\x80\x80\xe3\x81\xa4\xe3\x81\xad\xe3\x81\xaa\xe3\x82\x89\xe3\x82\x80\xe3\x80\x80\xe3\x81\x86\xe3\x82\x90\xe3\x81\xae\xe3\x81\x8a\xe3\x81\x8f\xe3\x82\x84\xe3\x81\xbe\xe3\x80\x80\xe3\x81\x91\xe3\x81\xb5\xe3\x81\x93\xe3\x81\x88\xe3\x81\xa6\xe3\x80\x80\xe3\x81\x82\xe3\x81\x95\xe3\x81\x8d\xe3\x82\x86\xe3\x82\x81\xe3\x81\xbf\xe3\x81\x97\xe3\x80\x80\xe3\x82\x91\xe3\x81\xb2\xe3\x82\x82\xe3\x81\x9b\xe3\x81\x99 </p>

<p lang=\"ja\">\xe8\x89\xb2\xe3\x81\xaf\xe5\x8c\x82\xe3\x81\xb8\xe3\x81\xa9\xe3\x80\x80\xe6\x95\xa3\xe3\x82\x8a\xe3\x81\xac\xe3\x82\x8b\xe3\x82\x92\xe3\x80\x80\xe6\x88\x91\xe3\x81\x8c\xe4\xb8\x96\xe8\xaa\xb0\xe3\x81\x9e\xe3\x80\x80\xe5\xb8\xb8\xe3\x81\xaa\xe3\x82\x89\xe3\x82\x80\xe3\x80\x80\xe6\x9c\x89\xe7\x82\xba\xe3\x81\xae\xe5\xa5\xa5\xe5\xb1\xb1\xe3\x80\x80\xe4\xbb\x8a\xe6\x97\xa5\xe8\xb6\x8a\xe3\x81\x88\xe3\x81\xa6\xe3\x80\x80\xe6\xb5\x85\xe3\x81\x8d\xe5\xa4\xa2\xe8\xa6\x8b\xe3\x81\x98\xe3\x80\x80\xe9\x85\x94\xe3\x81\xb2\xe3\x82\x82\xe3\x81\x9b\xe3\x81\x9a\xef\xbc\x88\xe3\x82\x93\xef\xbc\x89 </p>

<h5>Tori Naku Uta </h5>

<p style=\"font-family: IPAGothicP\">\xe3\x81\xa8\xe3\x82\x8a\xe3\x81\xaa\xe3\x81\x8f\xe3\x81\x93\xe3\x82\x91\xe3\x81\x99\xe3\x80\x80\xe3\x82\x86\xe3\x82\x81\xe3\x81\x95\xe3\x81\xbe\xe3\x81\x9b\xe3\x80\x80\xe3\x81\xbf\xe3\x82\x88\xe3\x81\x82\xe3\x81\x91\xe3\x82\x8f\xe3\x81\x9f\xe3\x82\x8b\xe3\x80\x80\xe3\x81\xb2\xe3\x82\x93\xe3\x81\x8b\xe3\x81\x97\xe3\x82\x92\xe3\x80\x80\xe3\x81\x9d\xe3\x82\x89\xe3\x81\x84\xe3\x82\x8d\xe3\x81\xaf\xe3\x81\x88\xe3\x81\xa6\xe3\x80\x80\xe3\x81\x8a\xe3\x81\x8d\xe3\x81\xa4\xe3\x81\xb8\xe3\x81\xab\xe3\x80\x80\xe3\x81\xbb\xe3\x81\xb5\xe3\x81\xad\xe3\x82\x80\xe3\x82\x8c\xe3\x82\x90\xe3\x81\xac\xe3\x80\x80\xe3\x82\x82\xe3\x82\x84\xe3\x81\xae\xe3\x81\x86\xe3\x81\xa1 </p>

<p lang=\"ja\">\xe9\xb3\xa5\xe5\x95\xbc\xe3\x81\x8f\xe5\xa3\xb0\xe3\x81\x99\xe3\x80\x80\xe5\xa4\xa2\xe8\xa6\x9a\xe3\x81\xbe\xe3\x81\x9b\xe3\x80\x80\xe8\xa6\x8b\xe3\x82\x88\xe6\x98\x8e\xe3\x81\x91\xe6\xb8\xa1\xe3\x82\x8b\xe3\x80\x80\xe6\x9d\xb1\xe3\x82\x92\xe3\x80\x80\xe7\xa9\xba\xe8\x89\xb2\xe6\xa0\x84\xe3\x81\x88\xe3\x81\xa6\xe3\x80\x80\xe6\xb2\x96\xe3\x81\xa4\xe8\xbe\xba\xe3\x81\xab\xe3\x80\x80\xe5\xb8\x86\xe8\x88\xb9\xe7\xbe\xa4\xe3\x82\x8c\xe3\x82\x90\xe3\x81\xac\xe3\x80\x80\xe9\x9d\x84\xe3\x81\xae\xe4\xb8\xad </p>

<h5>Ametsuchi No Uta </h5>

<p style=\"font-family: IPAGothicP\">\xe3\x81\x82\xe3\x82\x81 \xe3\x81\xa4\xe3\x81\xa1 \xe3\x81\xbb\xe3\x81\x97 \xe3\x81\x9d\xe3\x82\x89 / \xe3\x82\x84\xe3\x81\xbe \xe3\x81\x8b\xe3\x81\xaf \xe3\x81\xbf\xe3\x81\xad \xe3\x81\x9f\xe3\x81\xab / \xe3\x81\x8f\xe3\x82\x82 \xe3\x81\x8d\xe3\x82\x8a \xe3\x82\x80\xe3\x82\x8d \xe3\x81\x93\xe3\x81\x91 / \xe3\x81\xb2\xe3\x81\xa8 \xe3\x81\x84\xe3\x81\xac \xe3\x81\x86\xe3\x81\xb8 \xe3\x81\x99\xe3\x82\x91 / \xe3\x82\x86\xe3\x82\x8f \xe3\x81\x95\xe3\x82\x8b \xe3\x81\x8a\xe3\x81\xb5 \xe3\x81\x9b\xe3\x82\x88 / \xe3\x81\x88\xe3\x81\xae\xe3\x81\x88*\xe3\x82\x92 \xe3\x81\xaa\xe3\x82\x8c \xe3\x82\x90\xe3\x81\xa6 </p>

<p lang=\"ja\">\xe5\xa4\xa9 \xe5\x9c\xb0 \xe6\x98\x9f \xe7\xa9\xba / \xe5\xb1\xb1 \xe5\xb7\x9d \xe5\xb3\xb0 \xe8\xb0\xb7 / \xe9\x9b\xb2 \xe9\x9c\xa7 \xe5\xae\xa4 \xe8\x8b\x94 / \xe4\xba\xba \xe7\x8a\xac \xe4\xb8\x8a \xe6\x9c\xab / \xe7\xa1\xab\xe9\xbb\x84 \xe7\x8c\xbf \xe7\x94\x9f\xe3\x81\xb5 \xe7\x82\xba\xe3\x82\x88 / \xe6\xa6\x8e\xe3\x81\xae \xe6\x9e\x9d\xe3\x82\x92 \xe9\xa6\xb4\xe3\x82\x8c \xe5\xb1\x85\xe3\x81\xa6 </p>

<h5>Taini no Uta </h5>

<p style=\"font-family: hannoma\">\xe3\x81\x9f\xe3\x82\x90\xe3\x81\xab\xe3\x81\x84\xe3\x81\xa6\xe3\x80\x80\xe3\x81\xaa\xe3\x81\xa4\xe3\x82\x80\xe3\x82\x8f\xe3\x82\x8c\xe3\x82\x92\xe3\x81\x9d\xe3\x80\x80\xe3\x81\x8d\xe3\x81\xbf\xe3\x82\x81\xe3\x81\x99\xe3\x81\xa8\xe3\x80\x80\xe3\x81\x82\xe3\x81\x95\xe3\x82\x8a\xe3\x81\x8a\xe3\x81\xb2\xe3\x82\x86\xe3\x81\x8f\xe3\x80\x80\xe3\x82\x84\xe3\x81\xbe\xe3\x81\x97\xe3\x82\x8d\xe3\x81\xae\xe3\x80\x80\xe3\x81\x86\xe3\x81\xa1\xe3\x82\x91\xe3\x81\xb8\xe3\x82\x8b\xe3\x81\x93\xe3\x82\x89\xe3\x80\x80\xe3\x82\x82\xe3\x81\xaf\xe3\x81\xbb\xe3\x81\x9b\xe3\x82\x88\xe3\x80\x80\xe3\x81\x88\xe3\x81\xb5\xe3\x81\xad\xe3\x81\x8b\xe3\x81\x91\xe3\x81\xac </p>

<p lang=\"ja\">\xe7\x94\xb0\xe5\xb1\x85\xe3\x81\xab\xe5\x87\xba\xe3\x81\xa7\xe3\x80\x80\xe8\x8f\x9c\xe6\x91\x98\xe3\x82\x80\xe3\x82\x8f\xe3\x82\x8c\xe3\x82\x92\xe3\x81\x9e\xe3\x80\x80\xe5\x90\x9b\xe5\x8f\xac\xe3\x81\x99\xe3\x81\xa8\xe3\x80\x80\xe6\xb1\x82\xe9\xa3\x9f\xe3\x82\x8a\xe8\xbf\xbd\xe3\x81\xb2\xe3\x82\x86\xe3\x81\x8f\xe3\x80\x80\xe5\xb1\xb1\xe5\x9f\x8e\xe3\x81\xae\xe3\x80\x80\xe6\x89\x93\xe9\x85\x94\xe3\x81\xb8\xe3\x82\x8b\xe5\xad\x90\xe3\x82\x89\xe3\x80\x80\xe8\x97\xbb\xe8\x91\x89\xe5\xb9\xb2\xe3\x81\x9b\xe3\x82\x88\xe3\x80\x80\xe3\x81\x88\xe8\x88\x9f\xe7\xb9\x8b\xe3\x81\x91\xe3\x81\xac </p>


<bookmark content=\"\xe7\xbe\x8e\xe5\x9b\xbd\xe8\x88\xaa\xe7\xa9\xba\xe4\xb8\x9a\xe5\xb7\xa8\">
<h4>Chinese (simplified) GB2312</h4>

<p style=\"font-family: sun-exta\">\xe6\x9d\xa5\xe8\x87\xaa\xe5\x95\x86\xe5\x8a\xa1\xe9\x83\xa8\xe6\x96\xb0\xe9\x97\xbb\xe5\x8a\x9e\xe5\x85\xac\xe5\xae\xa4\xe7\x9a\x84\xe6\xb6\x88\xe6\x81\xaf\xe7\xa7\xb0\xef\xbc\x8c\xe4\xb8\xad\xe6\x96\xb9\xe5\x85\x8d\xe9\x99\xa4\xe4\xb8\x8e\xe4\xb8\xad\xe5\x9b\xbd\xe6\x9c\x89\xe5\xa4\x96\xe4\xba\xa4\xe5\x85\xb3\xe7\xb3\xbb\xe7\x9a\x84\xe6\x89\x80\xe6\x9c\x89\xe9\x9d\x9e\xe6\xb4\xb2\xe9\x87\x8d\xe5\x80\xba\xe7\xa9\xb7\xe5\x9b\xbd\xe5\x8f\x8a\xe6\x9c\x80\xe4\xb8\x8d\xe5\x8f\x91\xe8\xbe\xbe\xe5\x9b\xbd\xe5\xae\xb6\xe6\x88\xaa\xe8\x87\xb32005\xe5\xb9\xb4\xe5\xba\x95\xe5\xaf\xb9\xe5\x8d\x8e\xe5\x88\xb0\xe6\x9c\x9f\xe6\x94\xbf\xe5\xba\x9c\xe6\x97\xa0\xe6\x81\xaf\xe8\xb4\xb7\xe6\xac\xbe\xe5\x80\xba\xe5\x8a\xa1\xe3\x80\x82\xe6\x9c\x89\xe5\x85\xb3\xe9\x83\xa8\xe9\x97\xa8\xe5\xb7\xb2\xe5\xaf\xb9\xe7\x9b\xb8\xe5\x85\xb3\xe5\x80\xba\xe5\x8a\xa1\xe8\xbf\x9b\xe8\xa1\x8c\xe5\x85\xa8\xe9\x9d\xa2\xe6\xb8\x85\xe7\x90\x86\xe6\xa0\xb8\xe5\xaf\xb9\xef\xbc\x8c\xe5\xaf\xb9\xe4\xb8\x8e\xe4\xb8\xad\xe5\x9b\xbd\xe6\x9c\x89\xe5\xa4\x96\xe4\xba\xa4\xe5\x85\xb3\xe7\xb3\xbb\xe7\x9a\x8433\xe4\xb8\xaa\xe9\x9d\x9e\xe6\xb4\xb2\xe9\x87\x8d\xe5\x80\xba\xe7\xa9\xb7\xe5\x9b\xbd\xe5\x92\x8c\xe6\x9c\x80\xe4\xb8\x8d\xe5\x8f\x91\xe8\xbe\xbe\xe5\x9b\xbd\xe5\xae\xb6\xef\xbc\x8c\xe5\x85\x8d\xe9\x99\xa4\xe5\x85\xb6\xe6\x88\xaa\xe8\x87\xb32005\xe5\xb9\xb4\xe5\xba\x95168\xe7\xac\x94\xe5\xaf\xb9\xe5\x8d\x8e\xe5\x88\xb0\xe6\x9c\x9f\xe6\x97\xa0\xe6\x81\xaf\xe8\xb4\xb7\xe6\xac\xbe\xe5\x80\xba\xe5\x8a\xa1\xe3\x80\x82\xe6\x8b\x9f\xe4\xba\x8e2007\xe5\xb9\xb4\xe5\xba\x95\xe5\x89\x8d\xe4\xb8\x8e\xe5\x8f\x97\xe6\x8f\xb4\xe5\x9b\xbd\xe5\x8a\x9e\xe7\x90\x86\xe5\xae\x8c\xe5\x85\x8d\xe5\x80\xba\xe5\x8d\x8f\xe8\xae\xae\xe3\x80\x82</p>


<bookmark content=\"\xe3\x80\x8c\xe6\x86\x82\xe9\xac\xb1\xe5\xb0\x8f\xe7\x8e\x8b\xe5\xad\x90\xe3\x80\x8d\">
<h4>Chinese (Traditional - Hong Kong)</h4>

<p lang=\"zh-HK\">\xe3\x80\x8c\xe6\x86\x82\xe9\xac\xb1\xe5\xb0\x8f\xe7\x8e\x8b\xe5\xad\x90\xe3\x80\x8d\xe6\x98\xaf\xe4\xb8\x80\xe5\x80\x8b\xe6\x95\x99\xe8\x82\xb2\xe7\xb6\xb2\xe7\xab\x99\xef\xbc\x8c\xe5\xae\x83\xe6\x88\x90\xe5\x8a\x9f\xe7\xb5\x90\xe5\x90\x88\xe4\xba\x86\xe9\xa6\x99\xe6\xb8\xaf\xe8\xb3\xbd\xe9\xa6\xac\xe6\x9c\x83\xe9\x98\xb2\xe6\xad\xa2\xe8\x87\xaa\xe6\xae\xba\xe7\xa0\x94\xe7\xa9\xb6\xe4\xb8\xad\xe5\xbf\x83\xe5\x90\x84\xe6\x96\xb9\xe9\x9d\xa2\xe7\x9a\x84\xe5\xb0\x88\xe6\x89\x8d\xef\xbc\x8c\xe7\x82\xba\xe9\x9d\x92\xe5\xb0\x91\xe5\xb9\xb4\xe4\xba\xba\xe6\x8f\x90\xe4\xbe\x9b\xe7\xb2\xbe\xe7\xa5\x9e\xe5\x81\xa5\xe5\xba\xb7\xe7\x9a\x84\xe8\xa8\x8a\xe6\x81\xaf\xef\xbc\x8c\xe5\xb0\x8d\xe6\x99\xae\xe5\x8f\x8a\xe6\x8a\x91\xe9\xac\xb1\xe7\x97\x87\xe7\x9f\xa5\xe8\xad\x98\xe7\x9a\x84\xe8\xb2\xa2\xe7\x8d\xbb\xe8\x89\xaf\xe5\xa4\x9a\xe3\x80\x82\xe5\x9c\xa8\xe9\xa6\x99\xe6\xb8\xaf\xef\xbc\x8c\xe5\xae\x83\xe6\x9b\xbe\xe7\x8d\xb2\xe9\x81\xb8\xe7\x82\xba\xe3\x80\x8c2004\xe5\xb9\xb4\xe5\x8d\x81\xe5\xa4\xa7\xe5\x81\xa5\xe5\xba\xb7\xe7\xb6\xb2\xe7\xab\x99\xe3\x80\x8d\xe4\xb9\x8b\xe4\xb8\x80\xef\xbc\x8c\xe8\xa9\xb2\xe9\xa0\x85\xe9\x81\xb8\xe8\x88\x89\xe8\x87\xaa2005\xe5\xb9\xb4\xe8\xb5\xb7\xe6\x94\xb9\xe5\x90\x8d\xe7\x8f\xbe\xe6\x99\x82\xe7\x9a\x84\xe3\x80\x8c\xe5\x84\xaa\xe7\xa7\x80\xe7\xb6\xb2\xe7\xab\x99\xe9\x81\xb8\xe8\x88\x89\xe3\x80\x8d\xe3\x80\x82\xe5\x85\xb6\xe8\xb2\xa2\xe7\x8d\xbb\xe5\x9c\xa8\xe5\x9c\x8b\xe9\x9a\x9b\xe9\x96\x93\xe4\xba\xa6\xe5\x82\x99\xe5\x8f\x97\xe8\x82\xaf\xe5\xae\x9a\xef\xbc\x8c2005\xe5\xb9\xb4\xef\xbc\x8c\xe8\xa9\xb2\xe7\xb6\xb2\xe7\xab\x99\xe6\xa6\xae\xe7\x8d\xb2\xe7\xac\xac\xe5\x85\xab\xe5\xb1\x86\xe3\x80\x8c\xe4\xba\x9e\xe6\xb4\xb2\xe5\x89\xb5\xe6\x96\xb0\xe5\xa4\xa7\xe7\x8d\x8e\xe3\x80\x8d\xe9\x8a\x80\xe7\x8d\x8e\xe3\x80\x82</p>



<bookmark content=\"\xed\x82\xa4\xec\x8a\xa4\xec\x9d\x98\">
<h4>Korean</h4>
<p style=\"font-family: unbatang_0613\">\xed\x82\xa4\xec\x8a\xa4\xec\x9d\x98 \xea\xb3\xa0\xec\x9c\xa0\xec\xa1\xb0\xea\xb1\xb4\xec\x9d\x80 \xec\x9e\x85\xec\x88\xa0\xeb\x81\xbc\xeb\xa6\xac \xeb\xa7\x8c\xeb\x82\x98\xec\x95\xbc \xed\x95\x98\xea\xb3\xa0 \xed\x8a\xb9\xeb\xb3\x84\xed\x95\x9c \xea\xb8\xb0\xec\x88\xa0\xec\x9d\x80 \xed\x95\x84\xec\x9a\x94\xec\xb9\x98 \xec\x95\x8a\xeb\x8b\xa4. </p>

</div>
";

//==============================================================
//==============================================================
//==============================================================

include("../mpdf.php");

$mpdf = new mPDF('-aCJK', 'A4', '', '', 32, 25, 27, 25, 16, 13);
$mpdf->SetDisplayMode('fullpage');

$mpdf->SetTitle($utxt['zh-CN']);
$mpdf->SetAuthor($utxt['zh-CN']);

// LOAD a stylesheet
$stylesheet = file_get_contents('mpdfstyleA4.css');
$mpdf->WriteHTML($stylesheet, 1); // The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
//==============================================================
//==============================================================
//==============================================================
?>