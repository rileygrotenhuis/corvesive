import prisma from '@/config/prisma';

class AllowanceController {
  updateDailyAllowance = async (req, res) => {
    const user = await prisma.user.update({
      where: {
        id: req.user,
      },
      data: {
        dailyAllowance: parseFloat(req.body.amount),
        currentBalance: parseFloat(req.body.amount),
      },
    });

    return res.status(200).json(user);
  };
}

export default AllowanceController;
