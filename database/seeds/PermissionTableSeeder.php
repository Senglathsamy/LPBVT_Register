<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [

            // Role
            [
                'name' => 'role-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນສິດທິຜູ້ໃຊ້ລະບົບ',
                'description' => 'Show Role'
            ],
            [
                'name' => 'role-create',
                'display_name' => 'ເພີ່ມສິດທິຜູ້ເຂົ້າໃຊ້ລະບົບ',
                'description' => 'Add Role'
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'ແກ້ໄຂສິດທິຜູ້ເຂົ້າໃຊ້ລະບົບ',
                'description' => 'Edit Role'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'ລົບສິດທິຜູ້ເຂົ້າໃຊ້ລະບົບ',
                'description' => 'Delete Role'
            ],

            // User
            [
                'name' => 'user-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນຜູ້ໃຊ້ລະບົບທັງໝົດ',
                'description' => 'Show User'
            ],
            [
                'name' => 'user-create',
                'display_name' => 'ເພີ່ມຂໍ້ມູນຜູ້ເຂົ້າໃຊ້ລະບົບ',
                'description' => 'Add User'
            ],
            [
                'name' => 'user-edit',
                'display_name' => 'ແກ້ໄຂຂໍ້ມູນຜູ້ເຂົ້າໃຊ້ລະບົບ',
                'description' => 'Edit User'
            ],
            [
                'name' => 'user-delete',
                'display_name' => 'ລົບຂໍ້ມູນຜູ້ເຂົ້າໃຊ້ລະບົບ',
                'description' => 'Delete User'
            ],

            // Student
            [
                'name' => 'student-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນນັກສຶກສາ',
                'description' => 'Show Student'
            ],
            [
                'name' => 'student-create',
                'display_name' => 'ເພີ່ມຂໍ້ມູນນັກສຶກສາ',
                'description' => 'Add Student'
            ],
            [
                'name' => 'student-edit',
                'display_name' => 'ແກ້ໄຂຂໍ້ມູນນັກສຶກສາ',
                'description' => 'Edit Student'
            ],
            [
                'name' => 'student-delete',
                'display_name' => 'ລົບຂໍ້ມູນນັກສຶກສາ',
                'description' => 'Delete Student'
            ],

            // Teacher
            [
                'name' => 'teacher-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນອາຈານ',
                'description' => 'Show Teacher'
            ],
            [
                'name' => 'teacher-create',
                'display_name' => 'ເພີ່ມຂໍ້ມູນອາຈານ',
                'description' => 'Add Teacher'
            ],
            [
                'name' => 'teacher-edit',
                'display_name' => 'ແກ້ໄຂຂໍ້ມູນອາຈານ',
                'description' => 'Edit Teacher'
            ],
            [
                'name' => 'teacher-delete',
                'display_name' => 'ລົບຂໍ້ມູນອາຈານ',
                'description' => 'Delete Teacher'
            ],

            // Department
            [
                'name' => 'dept-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນພາກວິຊາ',
                'description' => 'Show Department'
            ],
            [
                'name' => 'dept-create',
                'display_name' => 'ເພີ່ມຂໍ້ມູນພາກວິຊາ',
                'description' => 'Add Department'
            ],
            [
                'name' => 'dept-edit',
                'display_name' => 'ແກ້ໄຂຂໍ້ມູນພາກວິຊາ',
                'description' => 'Edit Department'
            ],
            [
                'name' => 'dept-delete',
                'display_name' => 'ລົບຂໍ້ມູນພາກວິຊາ',
                'description' => 'Delete Department'
            ],

            // Major
            [
                'name' => 'major-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນສາຂາວິຊາ',
                'description' => 'Show Major'
            ],
            [
                'name' => 'major-create',
                'display_name' => 'ເພີ່ມຂໍ້ມູນສາຂາວິຊາ',
                'description' => 'Add Major'
            ],
            [
                'name' => 'major-edit',
                'display_name' => 'ແກ້ໄຂຂໍ້ມູນສາຂາວິຊາ',
                'description' => 'Edit Major'
            ],
            [
                'name' => 'major-delete',
                'display_name' => 'ລົບຂໍ້ມູນສາຂາວິຊາ',
                'description' => 'Delete Major'
            ],

            // Subject
            [
                'name' => 'subject-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນລາຍວິຊາ',
                'description' => 'Show Subject'
            ],
            [
                'name' => 'subject-create',
                'display_name' => 'ເພີ່ມຂໍ້ມູນລາຍວິຊາ',
                'description' => 'Add Subject'
            ],
            [
                'name' => 'subject-edit',
                'display_name' => 'ແກ້ໄຂຂໍ້ມູນລາຍວິຊາ',
                'description' => 'Edit Subject'
            ],
            [
                'name' => 'subject-delete',
                'display_name' => 'ລົບຂໍ້ມູນລາຍວິຊາ',
                'description' => 'Delete Subject'
            ],

            // Degree
            [
                'name' => 'degree-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນລະບົບການຮຽນ',
                'description' => 'Show Degree'
            ],
            [
                'name' => 'degree-create',
                'display_name' => 'ເພີ່ມຂໍ້ມູນລະບົບການຮຽນ',
                'description' => 'Add Degree'
            ],
            [
                'name' => 'degree-edit',
                'display_name' => 'ແກ້ໄຂຂໍ້ມູນລະບົບການຮຽນ',
                'description' => 'Edit Degree'
            ],
            [
                'name' => 'degree-delete',
                'display_name' => 'ລົບຂໍ້ມູນລະບົບການຮຽນ',
                'description' => 'Delete Degree'
            ],

            // Course
            [
                'name' => 'course-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນຫລັກສູດການຮຽນ-ການສອນ',
                'description' => 'Show Course'
            ],
            [
                'name' => 'course-create',
                'display_name' => 'ເພີ່ມຂໍ້ມູນຫລັກສູດການຮຽນ-ການສອນ',
                'description' => 'Add Course'
            ],
            [
                'name' => 'course-edit',
                'display_name' => 'ແກ້ໄຂຂໍ້ມູນຫລັກສູດການຮຽນ-ການສອນ',
                'description' => 'Edit Course'
            ],
            [
                'name' => 'course-delete',
                'display_name' => 'ລົບຂໍ້ມູນຫລັກສູດການຮຽນ-ການສອນ',
                'description' => 'Delete Course'
            ],

            // Teacher Match Subject
            [
                'name' => 'teacher-subject-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນອາຈານສອນ - ວິຊາສອນ',
                'description' => 'Show Teacher With Subject'
            ],
            [
                'name' => 'teacher-subject-create',
                'display_name' => 'ເພີ່ມຂໍ້ມູນອາຈານສອນ - ວິຊາສອນ',
                'description' => 'Add Teacher With Subject'
            ],
            [
                'name' => 'teacher-subject-edit',
                'display_name' => 'ແກ້ໄຂຂໍ້ມູນອາຈານສອນ - ວິຊາສອນ',
                'description' => 'Edit Teacher With Subject'
            ],
            [
                'name' => 'teacher-subject-delete',
                'display_name' => 'ລົບຂໍ້ມູນອາຈານສອນ - ວິຊາສອນ',
                'description' => 'Delete Teacher With Subject'
            ],

            // Register Learn
            [
                'name' => 'register-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນລົງທະບຽນຮຽນ',
                'description' => 'Show Register'
            ],
            [
                'name' => 'register-create',
                'display_name' => 'ເພີ່ມຂໍ້ມູນລົງທະບຽນຮຽນ',
                'description' => 'Add Register'
            ],
            [
                'name' => 'register-edit',
                'display_name' => 'ແກ້ໄຂຂໍ້ມູນລົງທະບຽນຮຽນ',
                'description' => 'Edit Register'
            ],
            [
                'name' => 'register-delete',
                'display_name' => 'ລົບຂໍ້ມູນລົງທະບຽນຮຽນ',
                'description' => 'Delete Register'
            ],

            // Register Upgrade
            [
                'name' => 'upgrade-list',
                'display_name' => 'ເບິ່ງຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ',
                'description' => 'Show Register Upgrade'
            ],
            [
                'name' => 'upgrade-create',
                'display_name' => 'ເພີ່ມຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ',
                'description' => 'Add Register Upgrade'
            ],
            [
                'name' => 'upgrade-edit',
                'display_name' => 'ແກ້ໄຂຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ',
                'description' => 'Edit Register Upgrade'
            ],
            [
                'name' => 'upgrade-delete',
                'display_name' => 'ລົບຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ',
                'description' => 'Delete Register Upgrade'
            ],

            // Manage Teacher To Subject
            [
                'name' => 'manage-teacher-subject',
                'display_name' => 'ຈັດການວິຊາສອນໃຫ້ອາຈານ',
                'description' => 'Show Manage Teacher To Subject'
            ],
//            [
//                'name' => 'manage-teacher-subject-edit',
//                'display_name' => 'ຈັດການວິຊາສອນໃຫ້ອາຈານ',
//                'description' => 'Edit Manage Teacher To Subject'
//            ],

            // Real Score
            [
                'name' => 'real-score',
                'display_name' => 'ຈັດການຂໍ້ມູນຄະແນນ',
                'description' => 'Show Score'
            ],
//            [
//                'name' => 'real-score-edit',
//                'display_name' => 'ແກ້ໄຂຂໍ້ມູນຄະແນນ',
//                'description' => 'Edit Score'
//            ],

            // Upgrade Score
            [
                'name' => 'upgrade-score',
                'display_name' => 'ຈັດການຂໍ້ມູນຄະແນນແກ້ເກຣດ',
                'description' => 'Show Upgrade Score'
            ],
//            [
//                'name' => 'upgrade-score-edit',
//                'display_name' => 'ແກ້ໄຂຂໍ້ມູນຄະແນນແກ້ເກຣດ',
//                'description' => 'Edit Upgrade Score'
//            ],

            // Report Student
            [
                'name' => 'report-student',
                'display_name' => 'ລາຍງານຂໍ້ມູນນັກສຶກສາ',
                'description' => 'Report Student'
            ],

            // Report Register
            [
                'name' => 'report-register',
                'display_name' => 'ລາຍງານຂໍ້ມູນລົງທະບຽນຮຽນ',
                'description' => 'Report Register'
            ],

            // Report Register Upgrade
            [
                'name' => 'report-upgrade',
                'display_name' => 'ລາຍງານການລົງທະບຽນແກ້ເກຣດ',
                'description' => 'Report Register Upgrade'
            ],

            // Report Grade
            [
                'name' => 'report-grade',
                'display_name' => 'ລາຍງານຂໍ້ມູນຜົນການຮຽນ',
                'description' => 'Report Grade'
            ],

            // Report Score
            [
                'name' => 'report-score',
                'display_name' => 'ລາຍງານໃບຄະແນນ',
                'description' => 'Report Score'
            ],


        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}
