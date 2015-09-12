<?php

namespace Nacha;

use Nacha\Field\String;
use Nacha\Field\Number;
use Nacha\Field\RoutingNumber;
use Nacha\Field\FileIdModifier;

class FileHeader {

	private $recordTypeCode;
	private $priorityCode;
	private $immediateDestination;
	private $immediateOrigin;
	private $fileCreationDate;
	private $fileCreationTime;
	private $fileIdModifier;
	private $recordSize;
	private $blockingFactor;
	private $formatCode;
	private $immediateDestinationName;
	private $immediateOriginName;
	private $referenceCode;

	public function __construct() {
		// defaults
		$this->setRecordTypeCode(1);
		$this->setRecordSize(94);
		$this->setBlockingFactor(10);
		$this->setFormatCode(1);
		$this->setFileIdModifier('A');
		$this->setFileCreationDate(date('ymd', time()));
		$this->setFileCreationTime(date('Hi', time()));

		// optional
		$this->setImmediateDestinationName('');
		$this->setImmediateOriginName('');
		$this->setReferenceCode('');
	}

	public function setRecordTypeCode($recordTypeCode) {
		$this->recordTypeCode = new Number($recordTypeCode, 1);
		return $this;
	}
	public function setPriorityCode($priorityCode) {
		$this->priorityCode = new Number($priorityCode, 2);
		return $this;
	}
	public function setImmediateDestination($immediateDestination) {
		$this->immediateDestination = new RoutingNumber($immediateDestination);
		return $this;
	}
	public function setImmediateOrigin($immediateOrigin) {
		$this->immediateOrigin = new RoutingNumber($immediateOrigin);
		return $this;
	}
	public function setFileCreationDate($fileCreationDate) {
		$this->fileCreationDate = new String($fileCreationDate, 6);
		return $this;
	}
	public function setFileCreationTime($fileCreationTime) {
		$this->fileCreationTime = new String($fileCreationTime, 4);
		return $this;
	}
	public function setFileIdModifier($fileIdModifier) {
		$this->fileIdModifier = new FileIdModifier($fileIdModifier);
		return $this;
	}
	public function setRecordSize($recordSize) {
		$this->recordSize = new Number($recordSize, 3);
		return $this;
	}
	public function setBlockingFactor($blockingFactor) {
		$this->blockingFactor = new Number($blockingFactor, 2);
		return $this;
	}
	public function setFormatCode($formatCode) {
		$this->formatCode = new Number($formatCode, 1);
		return $this;
	}
	public function setImmediateDestinationName($immediateDestinationName) {
		$this->immediateDestinationName = new String($immediateDestinationName, 23);
		return $this;
	}
	public function setImmediateOriginName($immediateOriginName) {
		$this->immediateOriginName = new String($immediateOriginName, 23);
		return $this;
	}
	public function setReferenceCode($referenceCode) {
		$this->referenceCode = new String($referenceCode, 8);
		return $this;
	}

	public function __toString() {
		return $this->recordTypeCode.
			$this->priorityCode.
			' '.$this->immediateDestination. // Prefixed with a space
			' '.$this->immediateOrigin.      // Prefixed with a space
			$this->fileCreationDate.
			$this->fileCreationTime.
			$this->fileIdModifier.
			$this->recordSize.
			$this->blockingFactor.
			$this->formatCode.
			$this->immediateDestinationName.
			$this->immediateOriginName.
			$this->referenceCode;
	}

}