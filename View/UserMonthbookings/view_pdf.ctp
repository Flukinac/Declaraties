<?php
    $totalContract = 0;
    $totalContractTwo = 0;
    $totalIntern = 0;
    $totalInternTwo = 0;
    $totalInternThree = 0;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">

<HTML>
<HEAD>

    <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=windows-1252">
    <TITLE></TITLE>
    <META NAME="GENERATOR" CONTENT="OpenOffice 4.1.5  (Win32)">
    <META NAME="CREATED" CONTENT="0;0">
    <META NAME="CHANGEDBY" CONTENT="Steven Visser">
    <META NAME="CHANGED" CONTENT="20181209;23163461">
    <!-- Documentinfo -->
    <!-- Afgedrukt: door Steven Visser op 04-12-2018, 11:51:16 -->

    <STYLE>
        <!--
        BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Arial"; font-size:x-small }
        -->
    </STYLE>

</HEAD>

<BODY TEXT="#000000">
<TABLE FRAME=VOID CELLSPACING=0 COLS=8 RULES=NONE BORDER=0>
    <COLGROUP><COL WIDTH=118><COL WIDTH=74><COL WIDTH=75><COL WIDTH=89><COL WIDTH=74><COL WIDTH=68><COL WIDTH=66><COL WIDTH=77></COLGROUP>
    <TBODY>
    <TR>
        <TD STYLE="border-top: 3px solid #000000; border-left: 3px solid #000000" COLSPAN=2 ROWSPAN=6 WIDTH=192 HEIGHT=109 ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR><?php echo $this->Html->image('qien.jpg', array('alt' => 'CakePHP', 'border' => '0', 'data-src' => 'holder.js/100%x100')); ?>
            </FONT></TD>
        <TD STYLE="border-top: 3px solid #000000" WIDTH=75 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000" WIDTH=89 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000" WIDTH=74 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000" WIDTH=68 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000" WIDTH=66 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000; border-right: 3px solid #000000" WIDTH=77 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT VALIGN=CENTER SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000">Medewerker</FONT></B></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=2 ALIGN=CENTER VALIGN=CENTER SDNUM="1043;1043;Standaard"><FONT FACE="Calibri"><?php echo AuthComponent::user('username'); ?></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT VALIGN=CENTER SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000">Opdracht</FONT></B></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=2 ALIGN=CENTER VALIGN=CENTER SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri">Qien</FONT></B></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT VALIGN=CENTER SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000">Maand</FONT></B></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=2 ALIGN=CENTER VALIGN=CENTER SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri"><?php echo date('F', time()); ?></FONT></B></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000; border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000; border-left: 3px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000">Datum</FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000"><?php echo $contracts[0]['Company']['name'] ?></FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000"></FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000">Overuren</FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000">Ziek</FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000">Overig</FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000">Verklaring</FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000; border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000"></FONT></B></TD>
    </TR>
    <TR>
        <TD STYLE="border-bottom: 3px solid #000000" HEIGHT=16 ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
<?php for ($i = 0; $i < count($daysColor);): ?>
    <TR>
        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; BACKGROUND:<?php echo $daysColor[++$i]; ?>" HEIGHT=16 ALIGN=CENTER VALIGN=BOTTOM SDVAL="43405" SDNUM="1043;1043;DD-MM-JJ"><FONT FACE="Calibri" COLOR="#000000" ><?php echo $i . '-' . $month . '-' . $year;?></FONT></TD>
        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDVAL="8" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"> <?php echo (isset($hours['UserMonthbooking']['contract_' . $i . '_' . $contracts[0]['Contracts']['contract_id']]) ? $hours['UserMonthbooking']['contract_' . $i . '_' . $contracts[0]['Contracts']['contract_id']] : ''); ?>    </FONT></TD>
        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><?php echo (isset($hours['UserMonthbooking']['contract_' . $i . '_' . $contracts[1]['Contracts']['contract_id']]) ? $hours['UserMonthbooking']['contract_' . $i . '_' . $contracts[1]['Contracts']['contract_id']] : ''); ?><BR></FONT></TD>
        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><?php echo (isset($hours['UserMonthbooking']['intern_' . $i . '_1']) ? $hours['UserMonthbooking']['intern_' . $i . '_1'] : '');?><BR></FONT></TD>
        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><?php echo (isset($hours['UserMonthbooking']['intern_' . $i . '_2']) ? $hours['UserMonthbooking']['intern_' . $i . '_2'] : '');?><BR></FONT></TD>
        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><?php echo (isset($hours['UserMonthbooking']['intern_' . $i . '_3']) ? $hours['UserMonthbooking']['intern_' . $i . '_3'] : '');?><BR></FONT></TD>
        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"></FONT></TD>
    </TR>
<?php $totalContract += (isset($hours['UserMonthbooking']['contract_' . $i . '_' . $contracts[0]['Contracts']['contract_id']]) ? $hours['UserMonthbooking']['contract_' . $i . '_' . $contracts[0]['Contracts']['contract_id']] : 0);?>
<?php $totalContractTwo += (isset($hours['UserMonthbooking']['contract_' . $i . '_' . $contracts[1]['Contracts']['contract_id']]) ? $hours['UserMonthbooking']['contract_' . $i . '_' . $contracts[1]['Contracts']['contract_id']] : 0);?>
<?php $totalIntern += (isset($hours['UserMonthbooking']['intern_' . $i . '_1']) ? $hours['UserMonthbooking']['intern_' . $i . '_1'] : 0);?>
<?php $totalInternTwo += (isset($hours['UserMonthbooking']['intern_' . $i . '_2']) ? $hours['UserMonthbooking']['intern_' . $i . '_2'] : 0);?>
<?php $totalInternThree += (isset($hours['UserMonthbooking']['intern_' . $i . '_3']) ? $hours['UserMonthbooking']['intern_' . $i . '_3'] : 0);?>
<?php endfor; ?>

    <TR>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 3px solid #000000; border-right: 1px solid #000000" HEIGHT=19 ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 3px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 3px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 3px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 3px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 3px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 3px solid #000000; border-left: 1px solid #000000" ALIGN=LEFT VALIGN=CENTER SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 3px solid #000000; border-right: 3px solid #000000" ALIGN=LEFT VALIGN=CENTER SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000; border-left: 3px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000">Totaal</FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDVAL="176" SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000"><?php echo $totalContract; ?></FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDVAL="0" SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000"><?php echo $totalContractTwo; ?></FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDVAL="0" SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000"><?php echo $totalIntern; ?></FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDVAL="0" SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000"><?php echo $totalInternTwo; ?></FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=CENTER VALIGN=BOTTOM SDVAL="0" SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000"><?php echo $totalInternThree; ?></FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000" ALIGN=RIGHT VALIGN=BOTTOM SDVAL="0" SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000"></FONT></B></TD>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000; border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></B></TD>
    </TR>
    <TR>
        <TD HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-top: 3px solid #000000; border-left: 3px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 3px solid #000000; border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-left: 3px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000">Medewerker</FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000">Opdrachtgever</FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-left: 3px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000">Naam</FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000">Naam</FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-left: 3px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=2 ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><?php echo AuthComponent::user('username'); ?></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=2 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#FFFFFF" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-left: 3px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-left: 3px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000">Handtekening </FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000">Handtekening</FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-left: 3px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=2 ROWSPAN=2 ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=2 ROWSPAN=2 ALIGN=CENTER VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-left: 3px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-bottom: 3px solid #000000; border-left: 3px solid #000000" HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD STYLE="border-bottom: 3px solid #000000; border-right: 3px solid #000000" ALIGN=LEFT VALIGN=BOTTOM BGCOLOR="#F2F2F2" SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD HEIGHT=19 ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
        <TD ALIGN=LEFT VALIGN=BOTTOM SDNUM="1043;1043;Standaard"><FONT FACE="Calibri" COLOR="#000000"><BR></FONT></TD>
    </TR>
    <TR>
        <TD STYLE="border-top: 3px solid #000000; border-bottom: 3px solid #000000; border-left: 3px solid #000000; border-right: 3px solid #000000" COLSPAN=8 HEIGHT=19 ALIGN=CENTER VALIGN=BOTTOM BGCOLOR="#9A35FF" SDNUM="1043;1043;Standaard"><B><FONT FACE="Calibri" COLOR="#FFFFFF">Qien B.V. Atoomweg 350, 3542 AB, Utrecht</FONT></B></TD>
    </TR>
    </TBODY>
</TABLE>
<!-- ************************************************************************** -->
</BODY>

</HTML>
