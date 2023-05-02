import Pagination from "@/Components/Pagination";
import AuthenticatedLayoutTeacher from "@/Layouts/AuthenticatedLayoutTeacher";
import getParameterByName from "@/Utils/getParameterByName";
import { PageProps } from "@/types";
import { Head, Link, useForm } from "@inertiajs/react";
import { Inertia } from "@inertiajs/inertia";
import { useEffect, useState } from "react";
import {
    FaDownload,
    FaPlusCircle,
    FaRegFileExcel,
    FaTrash,
} from "react-icons/fa";
export default function Teach(
    {
        auth,
        gradeStudents,
        schedule,
        presence,
        grade,
        flash,
        search,
        grade_id,
    }: PageProps,
    props: any
) {
    const { data, setData, errors, post } = useForm({
        search: search || "",
        page: getParameterByName("page") || 1,
        presences: [],
    });

    const [presences, setPresences] = useState([] as any);

    function handleSubmit(e: any) {
        e.preventDefault();
        console.log(data.presences);
        post(
            route("presences.detailStore", {
                schedule: schedule.id,
                presence: presence.id,
                grade: grade.id,
            })
        );
    }

    useEffect(() => {
        setData("presences", presences);
    }, [presences]);

    return (
        <>
            <AuthenticatedLayoutTeacher
                user={auth.user}
                header={
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Daftar Siswa
                    </h2>
                }
            >
                <Head title="Daftar Siswa" />
                <div className="py-12">
                    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        {flash.message && (
                            <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                                <span className="block sm:inline">
                                    {flash.message}
                                </span>
                            </div>
                        )}
                        {flash.error && (
                            <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                                <span className="block sm:inline">
                                    {flash.error}
                                </span>
                            </div>
                        )}

                        <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div className="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                                <div className="overflow-x-auto w-full px-4">
                                    <span>
                                        <b>Nama Kelas :</b>
                                        <b>Tahun Ajaran :</b>
                                    </span>
                                </div>
                                <form onSubmit={handleSubmit}>
                                    <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    className="px-6 py-3"
                                                >
                                                    Name
                                                </th>

                                                <th
                                                    scope="col"
                                                    className="px-6 py-3"
                                                >
                                                    Status Kehadiran
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {gradeStudents.map(
                                                (gradeStudent: any) => (
                                                    <tr
                                                        className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                                        key={gradeStudent.id}
                                                    >
                                                        <th
                                                            scope="row"
                                                            className="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white"
                                                        >
                                                            <div className="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                                                <span className="font-medium text-gray-600 dark:text-gray-300">
                                                                    {
                                                                        gradeStudent
                                                                            .student
                                                                            .name[0]
                                                                    }
                                                                </span>
                                                            </div>
                                                            <div className="pl-3">
                                                                <div className="text-base font-semibold">
                                                                    {
                                                                        gradeStudent
                                                                            .student
                                                                            .name
                                                                    }
                                                                </div>
                                                                <div className="text-xs text-gray-600 dark:text-gray-400">
                                                                    {
                                                                        gradeStudent
                                                                            .student
                                                                            .nis
                                                                    }
                                                                </div>
                                                            </div>
                                                        </th>

                                                        <td className="px-6 py-4">
                                                            <div className="relative z-0 w-full mb-6 group">
                                                                <select
                                                                    name="gender"
                                                                    id="gender"
                                                                    className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                    placeholder=" "
                                                                    required
                                                                    onChange={(
                                                                        e
                                                                    ) => {
                                                                        let dataArray =
                                                                            {
                                                                                student_id:
                                                                                    gradeStudent.student_id,
                                                                                status: e
                                                                                    .target
                                                                                    .value,
                                                                            };
                                                                        setPresences(
                                                                            [
                                                                                ...presences,
                                                                                dataArray,
                                                                            ]
                                                                        );
                                                                    }}
                                                                >
                                                                    <option
                                                                        selected
                                                                        disabled
                                                                        value=""
                                                                    >
                                                                        Pilih
                                                                    </option>
                                                                    <option value="H">
                                                                        Hadir
                                                                    </option>
                                                                    <option value="I">
                                                                        Ijin
                                                                    </option>
                                                                    <option value="A">
                                                                        Alpa
                                                                    </option>
                                                                    <option value="S">
                                                                        Sakit
                                                                    </option>
                                                                </select>

                                                                <span className="text-red-600"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                )
                                            )}
                                            {gradeStudents.length === 0 && (
                                                <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                    <td
                                                        className="w-4 p-4"
                                                        colSpan={5}
                                                    >
                                                        <div className="flex items-center justify-center">
                                                            <div className="text-center">
                                                                <div className="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                                    Data tidak
                                                                    ditemukan
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            )}
                                        </tbody>
                                    </table>
                                    <button
                                        type="submit"
                                        className="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    >
                                        Tambah
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </AuthenticatedLayoutTeacher>
        </>
    );
}
function debounce(arg0: () => void, arg1: number) {
    throw new Error("Function not implemented.");
}
