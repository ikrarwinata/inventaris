<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 // Load library phpspreadsheet
require_once(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'phpspreadsheet/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Asets_ruangan_view_model");
        $this->load->model("Ruangan_model");
        $this->load->model("Mutasi_model");
        $this->load->model("List_kondisi_model");
        $this->load->model("Semua_asets_view_model");
        $this->load->model("Asets_non_ruangan_view_model");
    }

    public function index()
    {
    }

    public function asets_all()
    {
        $cmerk = $this->input->post("cmerk");
        $cmerk = $this->input->post("cmerk");
        $ctipe = $this->input->post("ctipe");
        $cukuran = $this->input->post("cukuran");
        $cbahan = $this->input->post("cbahan");
        $ctahun = $this->input->post("ctahun");
        $cunit = $this->input->post("cunit");
        $charga = $this->input->post("charga");
        $ckondisi = $this->input->post("ckondisi");
        $cketerangan = $this->input->post("cketerangan");
        $cfoto = $this->input->post("cfoto");

        $HeaderStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) 
            )
        );
        $TitleStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
        );

        $namaFile = "Semua Asets - " . date("d-m-Y H-i");
        $judul = "DAFTAR INVENTARIS";

        $spreadsheet = new Spreadsheet();
        //penulisan header
        $spreadsheet->getProperties()->setCreator('Diki Handika-STMIK NH Jambi')
            ->setLastModifiedBy('SHS')
            ->setTitle($judul)
            ->setSubject($judul)
            ->setDescription($judul . date("d-m-Y"))
            ->setKeywords($judul)
            ->setCategory("Inventaris, Barang");

        // Set Header, style, and merging cells
        $rowHeader = 4;
        $ColIndexChar = "A";

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', $judul);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$rowHeader, 'No. Urut');
        $spreadsheet->getActiveSheet()->mergeCells("A" . $rowHeader . ":A" . ($rowHeader + 1));
        $spreadsheet->getActiveSheet()->getStyle("A".$rowHeader.':A'.($rowHeader + 1))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(TRUE);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$rowHeader, 'Kode Barang');
        $spreadsheet->getActiveSheet()->mergeCells("B".$rowHeader.":B".($rowHeader + 1));
        $spreadsheet->getActiveSheet()->getStyle("B".$rowHeader.':B'.($rowHeader + 1))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(TRUE);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$rowHeader, 'Nama Barang');
        $spreadsheet->getActiveSheet()->mergeCells("C" . $rowHeader . ":C" . ($rowHeader + 1));
        $spreadsheet->getActiveSheet()->getStyle("C".$rowHeader.':C'.($rowHeader + 1))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(TRUE);

        $counter = 4;
        if($cmerk){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Merk / Model');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($ctipe){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Tipe Aset');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($cukuran){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Ukuran');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        } 
        if($cbahan){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Bahan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($ctahun){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Tahun Pengadaan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        $indexofunit = 0;
        if($cunit){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Jumlah Barang');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $indexofunit = $counter;
            $counter++;
        }
        $indexofharga = 0;
        if($charga){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Harga');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $indexofharga = $counter;
            $counter++;
        }

        if($ckondisi){
            $kondisi = $this->List_kondisi_model->get_all();
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Keadaan Barang');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".columnLetter($counter + count($kondisi) - 1).$rowHeader);
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.columnLetter($counter + count($kondisi) - 1).$rowHeader)->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);

            foreach ($kondisi as $value) {
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()
                    ->setCellValueByColumnAndRow($counter++, ($rowHeader + 1), $value->kondisi);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            };
        }
        
        if($cketerangan){
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($counter, $rowHeader, 'Keterangan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($cfoto){
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($counter, $rowHeader, 'Foto');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $counter++;
        }
        $counter--;

        $spreadsheet->getActiveSheet()->mergeCells("A1:" .columnLetter($counter). "1");
        $spreadsheet->getActiveSheet()->getStyle("A1:".columnLetter($counter)."1")->applyFromArray($TitleStyle);
        // End Settings

        $datas = $this->Semua_asets_view_model->get_all();

        $i=$rowHeader+2;
        $nourut = 1;
        $ccounter = 3;
        foreach($datas as $value) {
            $ccounter = 4;
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$i, $nourut++);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$i, $value->kodebarang);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$i, $value->namabarang);
            if($cmerk) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->merk);
            if($ctipe) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->tipe);
            if($cukuran) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->ukuran);
            if($cbahan) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->bahan);
            if($ctahun) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->tahun);
            if($cunit){
                $spreadsheet->getActiveSheet()->getCell(columnLetter($ccounter).$i)->setValueExplicit($value->unit, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $ccounter++;
            } 
            if($charga){
                $spreadsheet->getActiveSheet()->getCell(columnLetter($ccounter).$i)->setValueExplicit($value->harga*$value->unit, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $ccounter++;
            }
            if($ckondisi){
                $indexKondisi = $ccounter;
                foreach ($kondisi as $val) {
                    if ($val->kondisi == $value->kondisi) break;
                    $indexKondisi++;
                }
                $spreadsheet->setActiveSheetIndex(0)->setCellValue(columnLetter($indexKondisi).$i, "Ya");
                $spreadsheet->getActiveSheet()->getStyle(columnLetter($indexKondisi).$i)->applyFromArray($TitleStyle);
            }
            $ccounter += count($kondisi);
            if($cketerangan) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++, $i, $value->keterangan);
            if($cfoto){
                if($value->foto != NULL){
                    $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter, $i, base_url($value->foto));
                    $spreadsheet->setActiveSheetIndex(0)->getCell(columnLetter($ccounter++).$i)->getHyperlink()->setUrl(base_url($value->foto));
                }
            }
            
            $i++;
        }

        if($cunit || $harga){
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $i, 'Jumlah');
            if($cunit){
                $ColIndexChar = columnLetter($indexofunit - 1);
                $spreadsheet->getActiveSheet()->mergeCells("A".$i.":".$ColIndexChar.$i);
                $spreadsheet->getActiveSheet()->getStyle("A".$i.":".$ColIndexChar.$i)->applyFromArray($HeaderStyle);

                $formulaunit = "=SUM(".columnLetter($indexofunit).($rowHeader+2).":".columnLetter($indexofunit).($i-1).")";
                $ColIndexChar = columnLetter($indexofunit);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($indexofunit, $i, $formulaunit);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }else{
                $ColIndexChar = columnLetter($indexofharga - 1);
                $spreadsheet->getActiveSheet()->mergeCells("A".$i.":".$ColIndexChar.$i);
                $spreadsheet->getActiveSheet()->getStyle("A".$i.":".$ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }

            if($charga){
                $formulaharga = "=SUM(".columnLetter($indexofharga).($rowHeader+2).":".columnLetter($indexofharga).($i-1).")";
                $ColIndexChar = columnLetter($indexofharga);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($indexofharga, $i, $formulaharga);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }
        }

        $spreadsheet->getActiveSheet()->setTitle('Semua Assets '.date('d-m-Y H-i'));
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->getPageSetup()
        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $namaFile .'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function asets_non_ruangan()
    {
        $cmerk = $this->input->post("cmerk");
        $cmerk = $this->input->post("cmerk");
        $ctipe = $this->input->post("ctipe");
        $cukuran = $this->input->post("cukuran");
        $cbahan = $this->input->post("cbahan");
        $ctahun = $this->input->post("ctahun");
        $cunit = $this->input->post("cunit");
        $charga = $this->input->post("charga");
        $ckondisi = $this->input->post("ckondisi");
        $cketerangan = $this->input->post("cketerangan");
        $cfoto = $this->input->post("cfoto");

        $HeaderStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) 
            )
        );
        $TitleStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
        );

        $namaFile = "Assets luar ruangan - " . date("d-m-Y H-i");
        $judul = "DAFTAR INVENTARIS (NON RUANGAN)";

        $spreadsheet = new Spreadsheet();
        //penulisan header
        $spreadsheet->getProperties()->setCreator('Diki Handika-STMIK NH Jambi')
            ->setLastModifiedBy('SHS')
            ->setTitle($judul)
            ->setSubject($judul)
            ->setDescription($judul . date("d-m-Y"))
            ->setKeywords($judul)
            ->setCategory("Inventaris, Barang");

        // Set Header, style, and merging cells
        $rowHeader = 4;
        $ColIndexChar = "A";

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', $judul);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$rowHeader, 'No. Urut');
        $spreadsheet->getActiveSheet()->mergeCells("A" . $rowHeader . ":A" . ($rowHeader + 1));
        $spreadsheet->getActiveSheet()->getStyle("A".$rowHeader.':A'.($rowHeader + 1))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(TRUE);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$rowHeader, 'Kode Barang');
        $spreadsheet->getActiveSheet()->mergeCells("B".$rowHeader.":B".($rowHeader + 1));
        $spreadsheet->getActiveSheet()->getStyle("B".$rowHeader.':B'.($rowHeader + 1))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(TRUE);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$rowHeader, 'Nama Barang');
        $spreadsheet->getActiveSheet()->mergeCells("C" . $rowHeader . ":C" . ($rowHeader + 1));
        $spreadsheet->getActiveSheet()->getStyle("C".$rowHeader.':C'.($rowHeader + 1))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(TRUE);

        $counter = 4;
        if($cmerk){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Merk / Model');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($ctipe){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Tipe Aset');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($cukuran){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Ukuran');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        } 
        if($cbahan){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Bahan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($ctahun){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Tahun Pengadaan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        $indexofunit = 0;
        if($cunit){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Jumlah Barang');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $indexofunit = $counter;
            $counter++;
        }
        $indexofharga = 0;
        if($charga){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Harga');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $indexofharga = $counter;
            $counter++;
        }

        if($ckondisi){
            $kondisi = $this->List_kondisi_model->get_all();
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Keadaan Barang');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".columnLetter($counter + count($kondisi) - 1).$rowHeader);
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.columnLetter($counter + count($kondisi) - 1).$rowHeader)->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);

            foreach ($kondisi as $value) {
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()
                    ->setCellValueByColumnAndRow($counter++, ($rowHeader + 1), $value->kondisi);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            };
        }
        
        if($cketerangan){
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($counter, $rowHeader, 'Keterangan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($cfoto){
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($counter, $rowHeader, 'Foto');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $counter++;
        }
        $counter--;

        $spreadsheet->getActiveSheet()->mergeCells("A1:" .columnLetter($counter). "1");
        $spreadsheet->getActiveSheet()->getStyle("A1:".columnLetter($counter)."1")->applyFromArray($TitleStyle);
        // End Settings

        $datas = $this->Asets_non_ruangan_view_model->get_all();

        $i=$rowHeader+2;
        $nourut = 1;
        $ccounter = 3;
        foreach($datas as $value) {
            $ccounter = 4;
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$i, $nourut++);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$i, $value->kodebarang);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$i, $value->namabarang);
            if($cmerk) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->merk);
            if($ctipe) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->tipe);
            if($cukuran) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->ukuran);
            if($cbahan) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->bahan);
            if($ctahun) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->tahun);
            if($cunit){
                $spreadsheet->getActiveSheet()->getCell(columnLetter($ccounter).$i)->setValueExplicit($value->unit*$value->unit, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $ccounter++;
            } 
            if($charga){
                $spreadsheet->getActiveSheet()->getCell(columnLetter($ccounter).$i)->setValueExplicit($value->harga, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $ccounter++;
            }
            if($ckondisi){
                $indexKondisi = $ccounter;
                foreach ($kondisi as $val) {
                    if ($val->kondisi == $value->kondisi) break;
                    $indexKondisi++;
                }
                $spreadsheet->setActiveSheetIndex(0)->setCellValue(columnLetter($indexKondisi).$i, "Ya");
                $spreadsheet->getActiveSheet()->getStyle(columnLetter($indexKondisi).$i)->applyFromArray($TitleStyle);
            }
            $ccounter += count($kondisi);
            if($cketerangan) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++, $i, $value->keterangan);
            if($cfoto){
                if($value->foto != NULL){
                    $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter, $i, base_url($value->foto));
                    $spreadsheet->setActiveSheetIndex(0)->getCell(columnLetter($ccounter++).$i)->getHyperlink()->setUrl(base_url($value->foto));
                }
            }
            
            $i++;
        }

        if($cunit || $harga){
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $i, 'Jumlah');
            if($cunit){
                $ColIndexChar = columnLetter($indexofunit - 1);
                $spreadsheet->getActiveSheet()->mergeCells("A".$i.":".$ColIndexChar.$i);
                $spreadsheet->getActiveSheet()->getStyle("A".$i.":".$ColIndexChar.$i)->applyFromArray($HeaderStyle);

                $formulaunit = "=SUM(".columnLetter($indexofunit).($rowHeader+2).":".columnLetter($indexofunit).($i-1).")";
                $ColIndexChar = columnLetter($indexofunit);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($indexofunit, $i, $formulaunit);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }else{
                $ColIndexChar = columnLetter($indexofharga - 1);
                $spreadsheet->getActiveSheet()->mergeCells("A".$i.":".$ColIndexChar.$i);
                $spreadsheet->getActiveSheet()->getStyle("A".$i.":".$ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }

            if($charga){
                $formulaharga = "=SUM(".columnLetter($indexofharga).($rowHeader+2).":".columnLetter($indexofharga).($i-1).")";
                $ColIndexChar = columnLetter($indexofharga);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($indexofharga, $i, $formulaharga);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }
        }

        $spreadsheet->getActiveSheet()->setTitle('Assets '.date('d-m-Y H-i'));
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->getPageSetup()
        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $namaFile .'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function asets_ruangan($idruangan)
    {
        $ruangan_data = $this->Ruangan_model->get_by_id($idruangan);
        $namaruangan = NULL;
        if($ruangan_data){
            $namaruangan = $ruangan_data->nama_ruangan;
        }else{
            $this->session->set_flashdata('message', 'Ruangan tidak ditemukan');
            redirect("Asets/laporan_ruangan");
            exit;
        }
        $cmerk = TRUE;
        $cmerk = TRUE;
        $ctipe = TRUE;
        $cukuran = TRUE;
        $cbahan = TRUE;
        $ctahun = TRUE;
        $cunit = TRUE;
        $charga = TRUE;
        $ckondisi = TRUE;
        $cketerangan = TRUE;
        $cfoto = TRUE;

        $HeaderStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) 
            )
        );
        $TitleStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
        );
        $SubTitleStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
        );

        $namaFile = "Assets Ruangan ".$idruangan." - " . date("d-m-Y H-i");
        $judul = "DAFTAR INVENTARIS RUANGAN (DIR)";

        $spreadsheet = new Spreadsheet();
        //penulisan header
        $spreadsheet->getProperties()->setCreator('Diki Handika-STMIK NH Jambi')
            ->setLastModifiedBy('SHS')
            ->setTitle($judul)
            ->setSubject($judul)
            ->setDescription($judul . date("d-m-Y"))
            ->setKeywords($judul)
            ->setCategory("Inventaris, Barang");

        // Set Header, style, and merging cells
        $rowHeader = 6;
        $ColIndexChar = "A";

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', $judul);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', "RUANGAN");
        $spreadsheet->getActiveSheet()->mergeCells("A3:B3");
        $spreadsheet->getActiveSheet()->getStyle("A3")->applyFromArray($SubTitleStyle);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C3', ": ".$namaruangan);
        $spreadsheet->getActiveSheet()->mergeCells("C3:D3");
        $spreadsheet->getActiveSheet()->getStyle("C3")->applyFromArray($SubTitleStyle);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$rowHeader, 'No. Urut');
        $spreadsheet->getActiveSheet()->mergeCells("A" . $rowHeader . ":A" . ($rowHeader + 1));
        $spreadsheet->getActiveSheet()->getStyle("A".$rowHeader.':A'.($rowHeader + 1))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(TRUE);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$rowHeader, 'Kode Barang');
        $spreadsheet->getActiveSheet()->mergeCells("B".$rowHeader.":B".($rowHeader + 1));
        $spreadsheet->getActiveSheet()->getStyle("B".$rowHeader.':B'.($rowHeader + 1))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(TRUE);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$rowHeader, 'Nama Barang');
        $spreadsheet->getActiveSheet()->mergeCells("C" . $rowHeader . ":C" . ($rowHeader + 1));
        $spreadsheet->getActiveSheet()->getStyle("C".$rowHeader.':C'.($rowHeader + 1))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(TRUE);

        $counter = 4;
        if($cmerk){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Merk / Model');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($ctipe){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Tipe Aset');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($cukuran){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Ukuran');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        } 
        if($cbahan){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Bahan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($ctahun){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Tahun Pengadaan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        $indexofunit = 0;
        if($cunit){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Jumlah Barang');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $indexofunit = $counter;
            $counter++;
        }
        $indexofharga = 0;
        if($charga){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Total Harga');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $indexofharga = $counter;
            $counter++;
        }

        if($ckondisi){
            $kondisi = $this->List_kondisi_model->get_all();
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Keadaan Barang');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".columnLetter($counter + count($kondisi) - 1).$rowHeader);
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.columnLetter($counter + count($kondisi) - 1).$rowHeader)->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);

            foreach ($kondisi as $value) {
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()
                    ->setCellValueByColumnAndRow($counter++, ($rowHeader + 1), $value->kondisi);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            };
        }
        
        if($cketerangan){
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($counter, $rowHeader, 'Keterangan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($cfoto){
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($counter, $rowHeader, 'Foto');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $counter++;
        }
        $counter--;

        $spreadsheet->getActiveSheet()->mergeCells("A1:" .columnLetter($counter). "1");
        $spreadsheet->getActiveSheet()->getStyle("A1:".columnLetter($counter)."1")->applyFromArray($TitleStyle);

        $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, 3, ": ".$idruangan);
        $spreadsheet->getActiveSheet()->getStyle(columnLetter($counter)."3")->applyFromArray($SubTitleStyle);
        $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter-2, 3, "NOMOR KODE RUANGAN");
        $spreadsheet->getActiveSheet()->mergeCells(columnLetter($counter-2)."3:".columnLetter($counter-1)."3");
        // End Settings

        $datas = $this->Asets_ruangan_view_model->get_by_ruangan($idruangan);

        $i=$rowHeader+2;
        $nourut = 1;
        $ccounter = 3;
        foreach($datas as $value) {
            $ccounter = 4;
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$i, $nourut++);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$i, $value->kodebarang);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$i, $value->namabarang);
            if($cmerk) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->merk);
            if($ctipe) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->tipe);
            if($cukuran) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->ukuran);
            if($cbahan) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->bahan);
            if($ctahun) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->tahun);
            if($cunit){
                $spreadsheet->getActiveSheet()->getCell(columnLetter($ccounter).$i)->setValueExplicit($value->unit, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $ccounter++;
            } 
            if($charga){
                $spreadsheet->getActiveSheet()->getCell(columnLetter($ccounter).$i)->setValueExplicit($value->harga*$value->unit, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $ccounter++;
            }
            if($ckondisi){
                $indexKondisi = $ccounter;
                foreach ($kondisi as $val) {
                    if ($val->kondisi == $value->kondisi) break;
                    $indexKondisi++;
                }
                $spreadsheet->setActiveSheetIndex(0)->setCellValue(columnLetter($indexKondisi).$i, "Ya");
                $spreadsheet->getActiveSheet()->getStyle(columnLetter($indexKondisi).$i)->applyFromArray($TitleStyle);
            }
            $ccounter += count($kondisi);
            if($cketerangan) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++, $i, $value->keterangan);
            if($cfoto){
                if($value->foto != NULL){
                    $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter, $i, base_url($value->foto));
                    $spreadsheet->setActiveSheetIndex(0)->getCell(columnLetter($ccounter++).$i)->getHyperlink()->setUrl(base_url($value->foto));
                }
            }
            
            $i++;
        }

        if($cunit || $harga){
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $i, 'Jumlah');
            if($cunit){
                $ColIndexChar = columnLetter($indexofunit - 1);
                $spreadsheet->getActiveSheet()->mergeCells("A".$i.":".$ColIndexChar.$i);
                $spreadsheet->getActiveSheet()->getStyle("A".$i.":".$ColIndexChar.$i)->applyFromArray($HeaderStyle);

                $formulaunit = "=SUM(".columnLetter($indexofunit).($rowHeader+2).":".columnLetter($indexofunit).($i-1).")";
                $ColIndexChar = columnLetter($indexofunit);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($indexofunit, $i, $formulaunit);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }else{
                $ColIndexChar = columnLetter($indexofharga - 1);
                $spreadsheet->getActiveSheet()->mergeCells("A".$i.":".$ColIndexChar.$i);
                $spreadsheet->getActiveSheet()->getStyle("A".$i.":".$ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }

            if($charga){
                $formulaharga = "=SUM(".columnLetter($indexofharga).($rowHeader+2).":".columnLetter($indexofharga).($i-1).")";
                $ColIndexChar = columnLetter($indexofharga);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($indexofharga, $i, $formulaharga);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }
        }

        $spreadsheet->getActiveSheet()->setTitle('Assets Ruangan '.date('d-m-Y H-i'));
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->getPageSetup()
        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $namaFile .'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function asets_ruangan_all()
    {
        $ruangan_data = $this->Ruangan_model->get_all();

        $cmerk = TRUE;
        $cmerk = TRUE;
        $ctipe = TRUE;
        $cukuran = TRUE;
        $cbahan = TRUE;
        $ctahun = TRUE;
        $cunit = TRUE;
        $charga = TRUE;
        $ckondisi = TRUE;
        $cketerangan = TRUE;
        $cfoto = TRUE;

        $HeaderStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) 
            )
        );
        $TitleStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
        );
        $SubTitleStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
        );

        $namaFile = "Assets Dalam Ruangan - " . date("d-m-Y H-i");
        $judul = "DAFTAR INVENTARIS RUANGAN (DIR)";

        $spreadsheet = new Spreadsheet();
        //penulisan header
        $spreadsheet->getProperties()->setCreator('Diki Handika-STMIK NH Jambi')
            ->setLastModifiedBy('SHS')
            ->setTitle($judul)
            ->setSubject($judul)
            ->setDescription($judul . date("d-m-Y"))
            ->setKeywords($judul)
            ->setCategory("Inventaris, Barang");

        $currentSheet = 0;

        foreach ($ruangan_data as $r) {
            if($currentSheet>=1) $spreadsheet->createSheet();
            // Set Header, style, and merging cells
            $rowHeader = 6;
            $ColIndexChar = "A";

            $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValue('A1', $judul);

            $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValue('A3', "RUANGAN");
            $spreadsheet->getActiveSheet()->mergeCells("A3:B3");
            $spreadsheet->getActiveSheet()->getStyle("A3")->applyFromArray($SubTitleStyle);
            $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValue('C3', ": ".$r->nama_ruangan);
            $spreadsheet->getActiveSheet()->mergeCells("C3:D3");
            $spreadsheet->getActiveSheet()->getStyle("C3")->applyFromArray($SubTitleStyle);

            $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValue('A'.$rowHeader, 'No. Urut');
            $spreadsheet->getActiveSheet()->mergeCells("A" . $rowHeader . ":A" . ($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle("A".$rowHeader.':A'.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(TRUE);

            $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValue('B'.$rowHeader, 'Kode Barang');
            $spreadsheet->getActiveSheet()->mergeCells("B".$rowHeader.":B".($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle("B".$rowHeader.':B'.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(TRUE);

            $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValue('C'.$rowHeader, 'Nama Barang');
            $spreadsheet->getActiveSheet()->mergeCells("C" . $rowHeader . ":C" . ($rowHeader + 1));
            $spreadsheet->getActiveSheet()->getStyle("C".$rowHeader.':C'.($rowHeader + 1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(TRUE);

            $counter = 4;
            if($cmerk){
                $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($counter, $rowHeader, 'Merk / Model');
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
                $counter++;
            }
            if($ctipe){
                $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($counter, $rowHeader, 'Tipe Aset');
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
                $counter++;
            }
            if($cukuran){
                $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($counter, $rowHeader, 'Ukuran');
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
                $counter++;
            } 
            if($cbahan){
                $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($counter, $rowHeader, 'Bahan');
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
                $counter++;
            }
            if($ctahun){
                $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($counter, $rowHeader, 'Tahun Pengadaan');
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
                $counter++;
            }
            $indexofunit = 0;
            if($cunit){
                $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($counter, $rowHeader, 'Jumlah Barang');
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
                $indexofunit = $counter;
                $counter++;
            }
            $indexofharga = 0;
            if($charga){
                $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($counter, $rowHeader, 'Total Harga');
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
                $indexofharga = $counter;
                $counter++;
            }

            if($ckondisi){
                $kondisi = $this->List_kondisi_model->get_all();
                $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($counter, $rowHeader, 'Keadaan Barang');
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".columnLetter($counter + count($kondisi) - 1).$rowHeader);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.columnLetter($counter + count($kondisi) - 1).$rowHeader)->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);

                foreach ($kondisi as $value) {
                    $ColIndexChar = columnLetter($counter);
                    $spreadsheet->getActiveSheet()
                        ->setCellValueByColumnAndRow($counter++, ($rowHeader + 1), $value->kondisi);
                    $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                    $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
                };
            }
            
            if($cketerangan){
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($counter, $rowHeader, 'Keterangan');
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
                $counter++;
            }
            if($cfoto){
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($counter, $rowHeader, 'Foto');
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".$ColIndexChar.($rowHeader + 1));
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.':'.$ColIndexChar.($rowHeader + 1))->applyFromArray($HeaderStyle);
                $counter++;
            }
            $counter--;

            $spreadsheet->getActiveSheet()->mergeCells("A1:" .columnLetter($counter). "1");
            $spreadsheet->getActiveSheet()->getStyle("A1:".columnLetter($counter)."1")->applyFromArray($TitleStyle);

            $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($counter, 3, ": ".$r->id);
            $spreadsheet->getActiveSheet()->getStyle(columnLetter($counter)."3")->applyFromArray($SubTitleStyle);
            $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($counter-2, 3, "NOMOR KODE RUANGAN");
            $spreadsheet->getActiveSheet()->mergeCells(columnLetter($counter-2)."3:".columnLetter($counter-1)."3");
            // End Settings

            $datas = $this->Asets_ruangan_view_model->get_by_ruangan($r->id);

            $i=$rowHeader+2;
            $nourut = 1;
            $ccounter = 3;
            foreach($datas as $value) {
                $ccounter = 4;
                $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValue('A'.$i, $nourut++);
                $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValue('B'.$i, $value->kodebarang);
                $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValue('C'.$i, $value->namabarang);
                if($cmerk) $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($ccounter++,$i, $value->merk);
                if($ctipe) $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($ccounter++,$i, $value->tipe);
                if($cukuran) $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($ccounter++,$i, $value->ukuran);
                if($cbahan) $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($ccounter++,$i, $value->bahan);
                if($ctahun) $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($ccounter++,$i, $value->tahun);
                if($cunit){
                    $spreadsheet->getActiveSheet()->getCell(columnLetter($ccounter).$i)->setValueExplicit($value->unit, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                    $ccounter++;
                } 
                if($charga){
                    $spreadsheet->getActiveSheet()->getCell(columnLetter($ccounter).$i)->setValueExplicit($value->harga*$value->unit, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                    $ccounter++;
                }
                if($ckondisi){
                    $indexKondisi = $ccounter;
                    foreach ($kondisi as $val) {
                        if ($val->kondisi == $value->kondisi) break;
                        $indexKondisi++;
                    }
                    $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValue(columnLetter($indexKondisi).$i, "Ya");
                    $spreadsheet->getActiveSheet()->getStyle(columnLetter($indexKondisi).$i)->applyFromArray($TitleStyle);
                }
                $ccounter += count($kondisi);
                if($cketerangan) $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($ccounter++, $i, $value->keterangan);
                if($cfoto){
                    if($value->foto != NULL){
                        $spreadsheet->setActiveSheetIndex($currentSheet)->setCellValueByColumnAndRow($ccounter, $i, base_url($value->foto));
                        $spreadsheet->setActiveSheetIndex($currentSheet)->getCell(columnLetter($ccounter++).$i)->getHyperlink()->setUrl(base_url($value->foto));
                    }
                }
                
                $i++;
            }

            if($cunit || $harga){
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $i, 'Jumlah');
                if($cunit){
                    $ColIndexChar = columnLetter($indexofunit - 1);
                    $spreadsheet->getActiveSheet()->mergeCells("A".$i.":".$ColIndexChar.$i);
                    $spreadsheet->getActiveSheet()->getStyle("A".$i.":".$ColIndexChar.$i)->applyFromArray($HeaderStyle);

                    $formulaunit = "=SUM(".columnLetter($indexofunit).($rowHeader+2).":".columnLetter($indexofunit).($i-1).")";
                    $ColIndexChar = columnLetter($indexofunit);
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($indexofunit, $i, $formulaunit);
                    $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$i)->applyFromArray($HeaderStyle);
                }else{
                    $ColIndexChar = columnLetter($indexofharga - 1);
                    $spreadsheet->getActiveSheet()->mergeCells("A".$i.":".$ColIndexChar.$i);
                    $spreadsheet->getActiveSheet()->getStyle("A".$i.":".$ColIndexChar.$i)->applyFromArray($HeaderStyle);
                }

                if($charga){
                    $formulaharga = "=SUM(".columnLetter($indexofharga).($rowHeader+2).":".columnLetter($indexofharga).($i-1).")";
                    $ColIndexChar = columnLetter($indexofharga);
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($indexofharga, $i, $formulaharga);
                    $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$i)->applyFromArray($HeaderStyle);
                }
            }

            $spreadsheet->getActiveSheet()->setTitle('Assets Ruangan '.date('d-m-Y H-i'));
            $spreadsheet->setActiveSheetIndex($currentSheet);
            $spreadsheet->getActiveSheet()->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            $currentSheet++;
        }
        
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $namaFile .'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function ruangan()
    {
        $clokasi = $this->input->post("clokasi");
        $cunit = $this->input->post("cunit");
        $cnilai = $this->input->post("cnilai");
        $cketerangan = $this->input->post("cketerangan");

        $HeaderStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) 
            )
        );
        $TitleStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
        );

        $namaFile = "Rekap Nilai Inventaris - " . date("d-m-Y H-i");
        $judul = "REKAPITULASI NILAI INVENTARIS (RUANGAN)";

        $spreadsheet = new Spreadsheet();
        //penulisan header
        $spreadsheet->getProperties()->setCreator('Diki Handika-STMIK NH Jambi')
            ->setLastModifiedBy('SHS')
            ->setTitle($judul)
            ->setSubject($judul)
            ->setDescription($judul . date("d-m-Y"))
            ->setKeywords($judul)
            ->setCategory("Inventaris, Barang");

        // Set Header, style, and merging cells
        $rowHeader = 4;
        $ColIndexChar = "A";

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', $judul);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$rowHeader, 'No. Urut');
        $spreadsheet->getActiveSheet()->getStyle("A".$rowHeader)->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(TRUE);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$rowHeader, 'Kode Ruangan');
        $spreadsheet->getActiveSheet()->getStyle("B".$rowHeader)->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(TRUE);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$rowHeader, 'Nama Ruangan');
        $spreadsheet->getActiveSheet()->getStyle("C".$rowHeader)->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(TRUE);

        $counter = 4;
        if($clokasi){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Lokasi Ruangan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader)->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        $indexofunit = 0;
        if($cunit){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Total Unit');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader)->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $indexofunit = $counter;
            $counter++;
        }
        $indexofnilai = 0;
        if($cnilai){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Nilai Inventaris');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader)->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $indexofnilai = $counter;
            $counter++;
        }
        if($cketerangan){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Keterangan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader)->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        $counter--;

        $spreadsheet->getActiveSheet()->mergeCells("A1:" .columnLetter($counter). "1");
        $spreadsheet->getActiveSheet()->getStyle("A1:".columnLetter($counter)."1")->applyFromArray($TitleStyle);
        // End Settings

        $datas = $this->Ruangan_model->get_view();

        $i=$rowHeader+1;
        $nourut = 1;
        foreach($datas as $value) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$i, $nourut++);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$i, $value->id);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$i, $value->nama_ruangan);
            $ccounter = 4;
            if($clokasi) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->lokasi);
            if($cunit){
                $spreadsheet->getActiveSheet()->getCell(columnLetter($ccounter).$i)->setValueExplicit($value->total_barang, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $ccounter++;
            } 
            if($cnilai){
                $spreadsheet->getActiveSheet()->getCell(columnLetter($ccounter).$i)->setValueExplicit($value->nilai*$value->total_barang, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $ccounter++;
            } 
            if($cketerangan) $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ccounter++,$i, $value->keterangan);
            
            $i++;
        }

        if($cunit || $cnilai){
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $i, 'Jumlah');
            if($cunit){
                $ColIndexChar = columnLetter($indexofunit - 1);
                $spreadsheet->getActiveSheet()->mergeCells("A".$i.":".$ColIndexChar.$i);
                $spreadsheet->getActiveSheet()->getStyle("A".$i.":".$ColIndexChar.$i)->applyFromArray($HeaderStyle);

                $formulaunit = "=SUM(".columnLetter($indexofunit).($rowHeader+1).":".columnLetter($indexofunit).($i-1).")";
                $ColIndexChar = columnLetter($indexofunit);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($indexofunit, $i, $formulaunit);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }else{
                $ColIndexChar = columnLetter($indexofnilai - 1);
                $spreadsheet->getActiveSheet()->mergeCells("A".$i.":".$ColIndexChar.$i);
                $spreadsheet->getActiveSheet()->getStyle("A".$i.":".$ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }

            if($cnilai){
                $formulanilai = "=SUM(".columnLetter($indexofnilai).($rowHeader+1).":".columnLetter($indexofnilai).($i-1).")";
                $ColIndexChar = columnLetter($indexofnilai);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($indexofnilai, $i, $formulanilai);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$i)->applyFromArray($HeaderStyle);
            }
        }

        $spreadsheet->getActiveSheet()->setTitle('Ruangan '.date('d-m-Y H-i'));
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->getPageSetup()
        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $namaFile .'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function mutasi()
    {
        $ctanggalmutasi = $this->input->post("ctanggal");
        $cakunposting = $this->input->post("cakun");
        $cketeranganmutasi = $this->input->post("cketerangan");
        $cdetail = $this->input->post("cdetail");

        $HeaderStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) 
            )
        );
        $TitleStyle = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ),
        );

        $namaFile = "Mutasi Assets - " . date("d-m-Y H-i");
        $judul = "DAFTAR MUTASI ASSETS";

        $spreadsheet = new Spreadsheet();
        //penulisan header
        $spreadsheet->getProperties()->setCreator('Diki Handika-STMIK NH Jambi')
            ->setLastModifiedBy('SHS')
            ->setTitle($judul)
            ->setSubject($judul)
            ->setDescription($judul . date("d-m-Y"))
            ->setKeywords($judul)
            ->setCategory("Inventaris, Barang");

        // Set Header, style, and merging cells
        $rowHeader = 4;
        $ColIndexChar = "A";

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', $judul);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$rowHeader, 'No. Urut');
        $spreadsheet->getActiveSheet()->mergeCells("A".$rowHeader.":A".($rowHeader+2));
        $spreadsheet->getActiveSheet()->getStyle("A".$rowHeader.":A".($rowHeader+2))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(TRUE);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$rowHeader, 'Sebelum Mutasi');
        $spreadsheet->getActiveSheet()->mergeCells("B".$rowHeader.":D".$rowHeader);
        $spreadsheet->getActiveSheet()->getStyle("B".$rowHeader.":D".$rowHeader)->applyFromArray($HeaderStyle);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.($rowHeader+1), 'Kode Barang');
        $spreadsheet->getActiveSheet()->mergeCells("B".($rowHeader+1).":B".($rowHeader+2));
        $spreadsheet->getActiveSheet()->getStyle("B".($rowHeader+1).":B".($rowHeader+2))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.($rowHeader+1), 'Kode Ruangan');
        $spreadsheet->getActiveSheet()->mergeCells("C".($rowHeader+1).":C".($rowHeader+2));
        $spreadsheet->getActiveSheet()->getStyle("C".($rowHeader+1).":C".($rowHeader+2))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.($rowHeader+1), 'Nama Ruangan');
        $spreadsheet->getActiveSheet()->mergeCells("D".($rowHeader+1).":D".($rowHeader+2));
        $spreadsheet->getActiveSheet()->getStyle("D".($rowHeader+1).":D".($rowHeader+2))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("D")->setAutoSize(TRUE);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$rowHeader, 'Setelah Mutasi');
        $spreadsheet->getActiveSheet()->mergeCells("E".$rowHeader.":G".$rowHeader);
        $spreadsheet->getActiveSheet()->getStyle("E".$rowHeader.":G".$rowHeader)->applyFromArray($HeaderStyle);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.($rowHeader+1), 'Kode Barang');
        $spreadsheet->getActiveSheet()->mergeCells("E".($rowHeader+1).":E".($rowHeader+2));
        $spreadsheet->getActiveSheet()->getStyle("E".($rowHeader+1).":E".($rowHeader+2))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("E")->setAutoSize(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.($rowHeader+1), 'Kode Ruangan');
        $spreadsheet->getActiveSheet()->mergeCells("F".($rowHeader+1).":F".($rowHeader+2));
        $spreadsheet->getActiveSheet()->getStyle("F".($rowHeader+1).":F".($rowHeader+2))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("F")->setAutoSize(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.($rowHeader+1), 'Nama Ruangan');
        $spreadsheet->getActiveSheet()->mergeCells("G".($rowHeader+1).":G".($rowHeader+2));
        $spreadsheet->getActiveSheet()->getStyle("G".($rowHeader+1).":G".($rowHeader+2))->applyFromArray($HeaderStyle);
        $spreadsheet->getActiveSheet()->getColumnDimension("G")->setAutoSize(TRUE);

        $counter = 8;
        if($ctanggalmutasi){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Tanggal Mutasi');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".columnLetter($counter).($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.":".columnLetter($counter).($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($cakunposting){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Akun Posting');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".columnLetter($counter).($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.":".columnLetter($counter).($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }
        if($cketeranganmutasi){
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'Keterangan Mutasi');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.$rowHeader.":".columnLetter($counter).($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.$rowHeader.":".columnLetter($counter).($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;
        }

        $spreadsheet->getActiveSheet()->mergeCells("A1:" .columnLetter($counter-1). "1");
        $spreadsheet->getActiveSheet()->getStyle("A1:".columnLetter($counter-1)."1")->applyFromArray($TitleStyle);
        
        $indexofdetail = 0;
        if($cdetail){
            $indexofdetail = $counter;
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, $rowHeader, 'DETAIL BARANG');
            
            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, ($rowHeader+1), 'Nama Barang');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, ($rowHeader+1), 'Merk / Model');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, ($rowHeader+1), 'Tipe Aset');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, ($rowHeader+1), 'Ukuran');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, ($rowHeader+1), 'Bahan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, ($rowHeader+1), 'Tahun Pengadaan');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, ($rowHeader+1), 'Jumlah Barang');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, ($rowHeader+1), 'Harga');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, ($rowHeader+1), 'Kondisi Barang');

            $list_kondisi = $this->List_kondisi_model->get_all();
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.($rowHeader+1).":".columnLetter(count($list_kondisi) + $counter - 1).($rowHeader+1));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader+1).":".columnLetter(count($list_kondisi) + $counter - 1).($rowHeader+1))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            foreach ($list_kondisi as $k) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, ($rowHeader+2), $k->kondisi);
                $ColIndexChar = columnLetter($counter);
                $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader+2))->applyFromArray($HeaderStyle);
                $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
                $counter++;
            }

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($counter, ($rowHeader+1), 'Foto');
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->mergeCells($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2));
            $spreadsheet->getActiveSheet()->getStyle($ColIndexChar.($rowHeader+1).":".$ColIndexChar.($rowHeader+2))->applyFromArray($HeaderStyle);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
            $counter++;

            $spreadsheet->getActiveSheet()->mergeCells(columnLetter($indexofdetail).$rowHeader.":".columnLetter($counter-1).$rowHeader);
            $spreadsheet->getActiveSheet()->getStyle(columnLetter($indexofdetail).$rowHeader.":".columnLetter($counter-1).$rowHeader)->applyFromArray($HeaderStyle);
        }else{
            $ColIndexChar = columnLetter($counter);
            $spreadsheet->getActiveSheet()->getColumnDimension($ColIndexChar)->setAutoSize(TRUE);
        }

        $counter--;
        // End Settings

        $mutasi_data = $this->Mutasi_model->get_view();

        $rowBody = $rowHeader+3;
        $nomor = 1;
        foreach ($mutasi_data as $value) {
            $colCounter = 1;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $nomor++);
            $colCounter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->kodebarang_lama);
            $colCounter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->idruangan_lama);
            $colCounter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->ruangan_lama);
            $colCounter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->kodebarang_baru);
            $colCounter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->idruangan_baru);
            $colCounter++;

            $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->ruangan_baru);
            $colCounter++;

            if($ctanggalmutasi){
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->tanggal);
                $colCounter++;
            }

            if($cakunposting){
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->user_posting);
                $colCounter++;
            }

            if($cketeranganmutasi){
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->keterangan);
                $colCounter++;
            }

            if($cdetail){
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->namabarang);
                $colCounter++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->merk);
                $colCounter++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->tipe);
                $colCounter++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->ukuran);
                $colCounter++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->bahan);
                $colCounter++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->tahun);
                $colCounter++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->unit);
                $colCounter++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, $value->harga);
                $colCounter++;

                $indexKondisi = $colCounter;
                foreach ($list_kondisi as $val) {
                    if ($val->kondisi == $value->kondisi) break;
                    $indexKondisi++;
                }
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($indexKondisi, $rowBody, "Ya");
                $spreadsheet->getActiveSheet()->getStyle(columnLetter($indexKondisi).$rowBody)->applyFromArray($TitleStyle);
                $colCounter += count($list_kondisi);

                if($value->foto != NULL){
                    $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, base_url($value->foto));
                    $spreadsheet->setActiveSheetIndex(0)->getCell(columnLetter($colCounter++).$rowBody)->getHyperlink()->setUrl(base_url($value->foto));
                }
            }else{
                $spreadsheet->setActiveSheetIndex(0)->setCellValueByColumnAndRow($colCounter, $rowBody, "<<Lihat Detail Barang>>");
                $spreadsheet->setActiveSheetIndex(0)->getCell(columnLetter($colCounter++).$rowBody)->getHyperlink()->setUrl(base_url("Mutasi/extern_read/".$value->id));
            }

            $rowBody++;
        }


        $spreadsheet->getActiveSheet()->setTitle('Mutasi '.date('d-m-Y H-i'));
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->getPageSetup()
        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $namaFile .'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

}

/* End of file Asets.php */
/* Location: ./application/controllers/Asets.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-05 10:55:33 */
/* http://harviacode.com */