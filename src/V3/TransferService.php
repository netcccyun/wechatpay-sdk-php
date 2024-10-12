<?php

namespace WeChatPay\V3;

use Exception;

/**
 * 商家转账服务类
 * @see https://pay.weixin.qq.com/docs/merchant/products/batch-transfer-to-balance/apilist.html
 */
class TransferService extends BaseService
{
    public function __construct(array $config)
    {
        parent::__construct($config);
    }


	/**
	 * 发起批量转账
	 * @param array $params 请求参数
	 * @return mixed {"out_batch_no":"商家批次单号","batch_id":"微信批次单号","create_time":"批次创建时间"}
	 * @throws Exception
	 */
    public function transfer(array $params)
    {
        $path = '/v3/transfer/batches';
        $publicParams = [
            'appid' => $this->appId,
        ];
        $params = array_merge($publicParams, $params);
        return $this->execute('POST', $path, $params, true);
    }

	/**
	 * 微信批次单号查询转账批次单
	 * @param string $batch_id 微信批次单号
	 * @param array $params 查询参数
	 * @return mixed {"transfer_batch":{},"transfer_detail_list":[]}
	 * @throws Exception
	 */
    public function transferbatch(string $batch_id, array $params){
        $path = '/v3/transfer/batches/batch-id/'.$batch_id;
        return $this->execute('GET', $path, $params);
    }

	/**
	 * 微信明细单号查询转账明细单
	 * @param string $batch_id 微信批次单号
	 * @param string $detail_id 微信明细单号
	 * @return mixed
	 * @throws Exception
	 */
    public function transferdetail(string $batch_id, string $detail_id){
        $path = '/v3/transfer/batches/batch-id/'.$batch_id.'/details/detail-id/'.$detail_id;
        return $this->execute('GET', $path);
    }

	/**
	 * 商家批次单号查询转账批次单
	 * @param string $out_batch_no 商家批次单号
	 * @param array $params 查询参数
	 * @return mixed {"transfer_batch":{},"transfer_detail_list":[]}
	 * @throws Exception
	 */
    public function transferoutbatch(string $out_batch_no, array $params){
        $path = '/v3/transfer/batches/out-batch-no/'.$out_batch_no;
        return $this->execute('GET', $path, $params);
    }

	/**
	 * 商家明细单号查询转账明细单
	 * @param string $out_batch_no 商家批次单号
	 * @param string $out_detail_no 商家明细单号
	 * @return mixed
	 * @throws Exception
	 */
    public function transferoutdetail(string $out_batch_no, string $out_detail_no){
        $path = '/v3/transfer/batches/out-batch-no/'.$out_batch_no.'/details/out-detail-no/'.$out_detail_no;
        return $this->execute('GET', $path);
    }

	/**
	 * 转账账单电子回单申请
	 * @param string $out_batch_no 商家批次单号
	 * @return mixed
	 * @throws Exception
	 */
    public function transferBatchReceiptApply(string $out_batch_no)
    {
        $path = '/v3/transfer/bill-receipt';
        $params = [
            'out_batch_no' => $out_batch_no
        ];
        return $this->execute('POST', $path, $params);
    }

	/**
	 * 查询转账账单电子回单
	 * @param string $out_batch_no 商家批次单号
	 * @return mixed
	 * @throws Exception
	 */
    public function transferBatchReceiptQuery(string $out_batch_no)
    {
        $path = '/v3/transfer/bill-receipt/'.$out_batch_no;
        return $this->execute('GET', $path);
    }

	/**
	 * 转账明细电子回单申请
	 * @param string $out_batch_no 商家批次单号
	 * @param string $out_detail_no 商家明细单号
	 * @return mixed
	 * @throws Exception
	 */
    public function transferDetailReceiptApply(string $out_batch_no, string $out_detail_no)
    {
        $path = '/v3/transfer-detail/electronic-receipts';
        $params = [
            'accept_type' => 'BATCH_TRANSFER',
            'out_batch_no' => $out_batch_no,
            'out_detail_no' => $out_detail_no
        ];
        return $this->execute('POST', $path, $params);
    }

	/**
	 * 查询转账明细电子回单
	 * @param string $out_batch_no 商家批次单号
	 * @param string $out_detail_no 商家明细单号
	 * @return mixed
	 * @throws Exception
	 */
    public function transferDetailReceiptQuery(string $out_batch_no, string $out_detail_no)
    {
        $path = '/v3/transfer-detail/electronic-receipts';
        $params = [
            'accept_type' => 'BATCH_TRANSFER',
            'out_batch_no' => $out_batch_no,
            'out_detail_no' => $out_detail_no
        ];
        return $this->execute('GET', $path, $params);
    }

}
