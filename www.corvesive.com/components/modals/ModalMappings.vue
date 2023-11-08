<script setup>
import useModalsStore from "~/stores/modals.js";
import ModalWrapper from "~/components/modals/ModalWrapper.vue";
import PayPeriodSelection from "~/components/payPeriods/PayPeriodSelection.vue";
import CreatePayPeriodForm from "~/components/payPeriods/CreatePayPeriodForm.vue";
import UpdatePayPeriodForm from "~/components/payPeriods/UpdatePayPeriodForm.vue";
import CreateBillForm from "~/components/bills/CreateBillForm.vue";
import UpdateBillForm from "~/components/bills/UpdateBillForm.vue";
import CreateBudgetForm from "~/components/budgets/CreateBudgetForm.vue";
import UpdateBudgetForm from "~/components/budgets/UpdateBudgetForm.vue";
import CreatePaystubForm from "~/components/paystubs/CreatePaystubForm.vue";
import UpdatePaystubForm from "~/components/paystubs/UpdatePaystubForm.vue";
import AttachPaystubForm from "~/components/paystubs/AttachPaystubForm.vue";
import AttachBudgetForm from "~/components/budgets/AttachBudgetForm.vue";
import UpdatePayPeriodBudgetForm from "~/components/budgets/UpdatePayPeriodBudgetForm.vue";
import AttachBillForm from "~/components/bills/AttachBillForm.vue";
import UpdatePayPeriodBillForm from "~/components/bills/UpdatePayPeriodBillForm.vue";
import BudgetTransactionForm from "~/components/transactions/BudgetTransactionForm.vue";
import BillTransactionForm from "~/components/transactions/BillTransactionForm.vue";
import DepositTransactionForm from "~/components/transactions/DepositTransactionForm.vue";
import UpdatePayPeriodPaystubForm from "~/components/paystubs/UpdatePayPeriodPaystubForm.vue";
import UpdateTransactionForm from "~/components/transactions/UpdateTransactionForm.vue";

const modalMappings = {
  "payPeriods.create": CreatePayPeriodForm,
  "payPeriods.update": UpdatePayPeriodForm,
  "payPeriods.select": PayPeriodSelection,
  "paystubs.create": CreatePaystubForm,
  "paystubs.update": UpdatePaystubForm,
  "budgets.create": CreateBudgetForm,
  "budgets.update": UpdateBudgetForm,
  "bills.create": CreateBillForm,
  "bills.update": UpdateBillForm,
  "payPeriods.paystubs.attach": AttachPaystubForm,
  "payPeriods.paystubs.update": UpdatePayPeriodPaystubForm,
  "payPeriods.budgets.attach": AttachBudgetForm,
  "payPeriods.budgets.update": UpdatePayPeriodBudgetForm,
  "payPeriods.bills.attach": AttachBillForm,
  "payPeriods.bills.update": UpdatePayPeriodBillForm,
  "transactions.budget": BudgetTransactionForm,
  "transactions.bill": BillTransactionForm,
  "transactions.deposit": DepositTransactionForm,
  "transactions.update": UpdateTransactionForm,
};
</script>

<template>
  <ModalWrapper
    :show="useModalsStore().open"
    @close="useModalsStore().closeModal"
  >
    <component :is="modalMappings[useModalsStore().type]" />
  </ModalWrapper>
</template>
