<?php 

declare(strict_types=1);

namespace OvanGmbh\ClassYear\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ListStudentsCommand extends Command
{
    /**
     * Configure the command by defining the name, options and arguments
     */
    protected function configure()
    {
        $this->setDescription('Show current students stored on the system.');
    }

    /**
     * Executes the command for showing sys_log entries
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title($this->getDescription());
        
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
        $result = $queryBuilder
            ->select('name')
            ->from('fe_users')
            ->where($queryBuilder->expr()->eq('tx_extbase_type', $queryBuilder->createNamedParameter('tx_classyear_domain_model_student')))
            ->execute()
            ->fetchAll();

        if(count($result)){
        $io->writeln('Students: ');

            $io->writeln(json_encode($result));
        }else{
            $io->writeln("no students found");
            return 0;
        }
        
    }
}