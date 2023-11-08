export default {
  server: {
    message: "A server error has occurred",
    type: "error",
  },
  createPayPeriodSuccess: {
    message: "Successfully created a new Pay Period",
    type: "success",
  },
  attachPayPeriodToPayPeriodSuccess: {
    message: "Successfully added Paystub to Pay Period",
    type: "success",
  },
  detachPayPeriodToPayPeriodSuccess: {
    message: "Successfully removed Paystub from Pay Period",
    type: "success",
  },
  attachPayPeriodToBillSuccess: {
    message: "Successfully added Bill to Pay Period",
    type: "success",
  },
  detachPayPeriodToBillSuccess: {
    message: "Successfully removed Bill from Pay Period",
    type: "success",
  },
  attachPayPeriodToBudgetSuccess: {
    message: "Successfully added Budget to Pay Period",
    type: "success",
  },
  detachPayPeriodToBudgetSuccess: {
    message: "Successfully removed Budget from Pay Period",
    type: "success",
  },
  successfulTransaction: {
    message: "Successfully completed a transaction",
    type: "success",
  },
  noPayPeriodsAvailable: {
    message:
      "You have not created any Pay Periods, please create one to get started!",
    type: "warning",
  },
  payPeriodSuccessfullyCompleted: {
    message:
      "You have successfully completed thie Pay Period. Metrics and data from this Pay Period have been saved for you to report on!",
    type: "success",
  },
  payPeriodUncompleted: {
    message: "You have marked this Pay Period is incomplete",
    type: "warning",
  },
  payPeriodIsCompleted: {
    message:
      "The currently selected Pay Period has been marked as completed and cannot be updated again unless marked as incomplete",
    type: "warning",
  },
  payPeriodSelected: {
    message: "You have changed your currently selected Pay Period",
    type: "success",
  },
  successfulTransactionUpdate: {
    message: "You have successfully updated one of your Transactions",
    type: "success",
  },
  successfulTransactionRefund: {
    message: "Successfully refunded Transaction!",
    type: "success",
  },
};
