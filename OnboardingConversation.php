<?php

use BotMan\BotMan\Messages\Conversations\Conversation;

class OnboardingConversation extends Conversation
{

    protected $firstname;
    protected $question;
    protected $choice;
    protected $action;

    public function askFirstname()
    {
        $this->ask('Hi, what is your name?', function($answer) {
            $firstName = $answer->getText();
            $this->say('Nice to meet you '.$firstName);
             $this->askquestion();
        });
    }

    public function askquestion()
    {
         $this->ask('How may I help you?', function($question) {
            $question = $question->getText();
            $this->say('Wait a minute..!');
            $this->say('There are some queries that i can help you with.');
            $this->say('1- How to register courses?');
            $this->say('2- How Pre Requisite subjects work?');
            $this->say('3- How to choose Best Counselor');
            $this->say('4- How much credit hours i can register at once?');
            $this->say('5- Why am i getting "Pre req required" while registering?');
            

            $this->providesolution();
        });

    }

    public function providesolution(){
        $this->ask('Reply with the number. i.e "1"' , function($number){
            $choice = $number->getText();

            if ($choice == '1') {
                $this->say('First! You must have a valid login issued from the institute. Then go to Courses -> Register Course and select the courses to register. Then submit the request after making sure because it is a 1 time registration.<br>
                    And You are done :)');
            }else if ($choice == '2') {
                $this->say('Subject with a pre requisite cannot be registered until there pre requisite is cleared. <br>
                            One must pass the pre requisite subject to register that new one.');
            }else if ($choice == '3') {
                $this->say('Couselors can be judged by their ratings that is given to them by other students. You can read previous reviews and thoughts about Counselors and can easily decide to choose an appropriate counselor for you.');
            }else if($choice == '4'){
                $this->say('One student can register maximum of 21 credit hours in a semester as per rules. You can not register more than 21 credit hours.');
            }else if ($choice == '5') {
                $this->say('You are getting this error becasue of a failed subject that is a pre requisite of this particular subject. You must clear that pre requisite subject in case to register this subject.');
            }
            else{
                $this->say('Sorry ! I can not answer that one'); 
            }

            $this->ask('Do you have another query? (yes/no)' , function($action){
                $action = $action->getText();

                if ($action == 'yes' || $action == 'y' || $action == 'Yes' || $action == 'Y') {
                    $this->askquestion();
                }else{
                    $this->say('Have a nice day. :)');
                }
            });
        });

    }


    public function run()
    {
        $this->say('Welcome to the ACCS virtual assistance.');
        $this->askFirstname();
       
    }
}
