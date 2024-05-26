import prisma from '@/config/prisma';

class NewDayController {
  newDay = async (req, res) => {
    const user = await prisma.user.findFirst({
      where: {
        id: req.user,
      },
    });

    const updatedUser = await prisma.user.update({
      where: {
        id: req.user,
      },
      data: {
        currentBalance: user.currentBalance + user.dailyAllowance,
      },
    });

    return res.status(200).json(updatedUser);
  };
}

export default NewDayController;
